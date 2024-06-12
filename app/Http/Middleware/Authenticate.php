<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
       // dd($request);
        //check if user is role admin
        if ($request->user() && $request->user()->hasRole('user')) {
            return null;
        }
        if($request-> routeIs('admin.*')){
            return route('admin.login');
        }else{
            return route('site.home');
        }
        //return $request->expectsJson() ? null : route('admin.login');
    }
}
