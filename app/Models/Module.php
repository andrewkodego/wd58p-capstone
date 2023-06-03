<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Module extends BaseModel
{
    
    public function moduleRights(){
        return $this->hasMany('App\Models\ModuleRight','module_id')->orderby('role_id','asc');
    }

    public function getUserModuleRightAttribute(){

        $moduleRight = null;
        $userProfile = Auth::user();
        if($userProfile){
            $topRole = $userProfile->topUserRole;
            if($topRole){
                $moduleRight = $this->moduleRights()->where('role_id', $topRole->role_id)->first();
                //$moduleRight = ModuleRight::where('module_id', $this->id)->where('role_id', $topRole->role_id)->orderby('role_id','asc')->first();
            }
        }

        return $moduleRight;
    }

    public function getUserCanViewAttribute(){
        
        $moduleRight = $this->userModuleRight;
        if($moduleRight && ($moduleRight->can_view_all == 1 || $moduleRight->can_view_own == 1)){
            return true;
        }

        return false;
    }

    public function getUserCanViewAllAttribute(){
        
        $moduleRight = $this->userModuleRight;
        if($moduleRight && ($moduleRight->can_view_all == 1)){
            return true;
        }

        return false;
    }

    public function getUserCanViewOwnOnlyAttribute(){
        
        $moduleRight = $this->userModuleRight;
        if($moduleRight && ($moduleRight->can_view_all == 0 && $moduleRight->can_view_own == 1)){
            return true;
        }

        return false;
    }

    public function getUserCanEditAttribute(){
        
        $moduleRight = $this->userModuleRight;
        if($moduleRight && ($moduleRight->can_edit_all == 1 || $moduleRight->can_edit_own == 1)){
            return true;
        }

        return false;
    }

    public function getUserCanAddAttribute(){
        
        $moduleRight = $this->userModuleRight;
        if($moduleRight && $moduleRight->can_add == 1){
            return true;
        }

        return false;
    }

    public function getUserCanDeleteAttribute(){
        
        $moduleRight = $this->userModuleRight;
        if($moduleRight && ($moduleRight->can_delete_all == 1 || $moduleRight->can_delete_own == 1)){
            return true;
        }

        return false;
    }
    
}
