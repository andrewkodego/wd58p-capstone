<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Module;
use App\Traits\ModuleRights;

class GateKeeper
{
    use ModuleRights;

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

        $hasAccess = $this->checkModuleAccess($routeName, $action);

        if(!$hasAccess){
            abort(401);
        }

        return $next($request); 
    }
}