<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Module;

class GateKeeper
{
    public function handle(Request $request, Closure $next): Response
    {
        $userProfile = Auth::user();
        if($userProfile && $userProfile->isSuperAdmin){
            return $next($request);
        }
        
        $routeName = $request->route()->getName();
        $routeArr = explode(".", $routeName);
        $action = $routeArr[count($routeArr) -1];

        if($action != 'index'){
            $routeName = str_replace($action, "index", $routeName);
        }

        $module = Module::where('route','=',$routeName)->first();
        if($module){
            $hasAccess = false;
            switch($action){
                case 'create':
                    case 'store':
                        $hasAccess = $module->userCanAdd;
                        break;
                case 'edit':
                case 'update':
                    $hasAccess = $module->userCanEdit;
                    break;               
                case 'destroy':
                    $hasAccess = $module->userCanDelete;
                    break;
                default:
                    $hasAccess = $module->userCanView;
                    break;
            }

            if(!$hasAccess){
                abort(401);
            }
        }else{
            abort(404);
        }

        return $next($request); 
    }
}