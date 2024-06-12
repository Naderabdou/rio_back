<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    { {
            if (!Auth::check()) // If the user is not logged in
                return redirect('/');

            $user = Auth::user();

           if (!$user->hasRole($role)) // If the user has the role
                return redirect('/');


            return $next($request); // Proceed if user has the role
        }
    }
}
