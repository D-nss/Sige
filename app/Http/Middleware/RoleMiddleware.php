<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\User;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role, $guard = null)
    {
        //$authGuard = Auth::guard($guard);
        //Pegando Autenticação do Keycloak e buscando usuário do banco e setando ele no sistema
        Auth::setUser(User::where('email', Auth::user()->id)->first());
        $authGuard = Auth::guard();

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (! $authGuard->user()->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }

        return $next($request);
    }
}
