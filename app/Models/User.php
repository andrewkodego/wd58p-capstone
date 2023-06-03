<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getStatusNameAttribute(){
        if(!$this->isDeleted){
            return 'Active';
        }else{
            return 'Archive';
        }
    }

    public function getIsDeletedAttribute(){
        if($this->deleted_at != null){
            return true;
        }else{
            return false;
        }
    }

    public function userRoles(){
        return $this->hasMany('App\Models\UserRole','user_id')->orderby('role_id','asc');
    }

    protected $_userRoleList = null;
    public function getTopUserRoleAttribute(){
        if($this->_userRoleList == null){
            $this->_userRoleList = $this->userRoles;
        }

        if(count($this->_userRoleList) > 0){
            return $this->_userRoleList[0];
        }
        return null;
    }

    public function getIsSuperAdminAttribute(){
        $topRole = $this->topUserRole;
        if($topRole && $topRole->role_id == 1){
            return true;
        }
        return false;
    }

    public function getIsAdminAttribute(){
        $topRole = $this->topUserRole;
        if($topRole && $topRole->role_id == 2){
            return true;
        }
        return false;
    }

    public function getIsAccountUserAttribute(){
        $topRole = $this->topUserRole;
        if($topRole && $topRole->role_id == 3){
            return true;
        }
        return false;
    }

    public function getMainMenuListAttribute(){
        return Module::where('parent_module_id', 2)->orderby('sort_order','asc')->orderby('name','asc')->get();
    }


}
