<?php

namespace App\Http\Middleware;

use App\Models\User as ModelsUser;
use Closure;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');
        foreach ($roles as $role) {
            

            $userWithRole = ModelsUser::with("role")->where("id", Auth::user()->id)->get()->first();
            if ($userWithRole->role->name == $role)
                return $next($request);
         
        }
        return redirect("login");
    }
}
