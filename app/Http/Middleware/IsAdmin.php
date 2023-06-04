<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Role::query()->where('name', 'LIKE', 'Администратор%')->get(['id', 'name'])->first();

        if(!empty($role) && !empty(auth()->user()))
        {
            if($request->user()->role_id == $role->id)
            {
                auth()->user()->is_admin = true;
                return $next($request);
            }
            auth()->user()->is_admin = false;
        }
        return $next($request);
    }
}
