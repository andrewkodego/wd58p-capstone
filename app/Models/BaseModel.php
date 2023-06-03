<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Traits\ModuleRights;
use App\Traits\OptionsList;


class BaseModel extends Model
{
    use HasFactory, SoftDeletes, ModuleRights, OptionsList;


    public function createdBy(){
        return $this->belongsTo('\App\Models\User','created_by')->withDefault();
    }

    public function modifiedBy(){
        return $this->belongsTo('\App\Models\User','modified_by')->withDefault();;
    }

    public function getCreatedDateAttribute(){
        return $this->formatDefaultDate($this->created_at);
    }

    public function getUpdatedDateAttribute(){
        return $this->formatDefaultDate($this->updated_at);
    }

    public function getDeletedDateAttribute(){
        return $this->formatDefaultDate($this->deleted_at);
    }

    protected function formatDefaultDate($date){
        if($date){
            return $date->format(config('constants.DEFAULT_DATE_FORMAT'));
        }        
        return '';
    }

    public function canEditRecord($routeName){
        $allowed = $this->checkModuleAccess($routeName, 'edit', 1);
        if(!$allowed){
            $allowed = $this->checkModuleAccess($routeName, 'edit', 2);
            if($allowed && $this->created_by == Auth::user()->id){
                $allowed = true;
            }else{
                $allowed = false;
            }
        }
        return $allowed;
    }

    public function canDeleteRecord($routeName){
        $allowed = $this->checkModuleAccess($routeName, 'destroy', 1);
        if(!$allowed){
            $allowed = $this->checkModuleAccess($routeName, 'destroy', 2);
            if($allowed && $this->created_by == Auth::user()->id){
                $allowed = true;
            }else{
                $allowed = false;
            }
        }
        return $allowed;
    }

    public function canViewAllRecords($routeName){
        return $this->checkModuleAccess($routeName, 'index', 1);
    }

    public function canViewOwnRecords($routeName){
        return $this->checkModuleAccess($routeName, 'index', 2);
    }

    public function scopeUserRecordsOnly($query, $routeName){
        
        if(!$this->canViewAllRecords($routeName)){
            if($this->canViewOwnRecords($routeName)){
                $query->where('created_by', Auth::user()->id);
            }else{
                $query->where('id', 0);
            }
        }

        return $query;

    }
}