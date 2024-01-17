<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission, $guard = null)
    {
        //$authGuard = app('auth')->guard($guard);
        //Pegando Autenticação do Keycloak e buscando usuário do banco e setando ele no sistema
        $user = User::where('uid', Auth::user()->id)->first();
        Auth::guard('web_user')->login($user);
        $authGuard = app('auth')->guard('web_user');

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if ($authGuard->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
