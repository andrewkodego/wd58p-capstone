<?php

namespace App\Traits;

use App\Models\Module;

trait ModuleRights{

    public function checkModuleAccess($routeName, $action, $level=0){

        $canAdd = 'userCanAdd';
        $canEdit = 'userCanEdit';
        $canDelete = 'userCanDelete';
        $canView = 'userCanView';

        if($level == 1){
            $canEdit = 'userCanEditAll';
            $canDelete = 'userCanDeleteAll';
            $canView = 'userCanViewAll';
        }elseif($level == 2){
            $canEdit = 'userCanEditOwnOnly';
            $canDelete = 'userCanDeleteOwnOnly';
            $canView = 'userCanViewOwnOnly';
        }

        $hasAccess = false;
        $module = Module::where('route','=',$routeName)->first();
        if($module){
            switch($action){
                case 'create':
                case 'store':
                    $hasAccess = $module[$canAdd];
                    break;
                case 'edit':
                case 'update':
                    $hasAccess = $module[$canEdit];
                    break;               
                case 'destroy':
                    $hasAccess = $module[$canDelete];
                    break;
                default:
                    $hasAccess = $module[$canView];
                    break;
            }
        }

        return $hasAccess;
    }
    

}