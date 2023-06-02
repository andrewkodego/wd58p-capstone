<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes;

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
}