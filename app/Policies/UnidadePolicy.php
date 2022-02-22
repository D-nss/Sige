<?php

namespace App\Policies;

use App\Models\Unidade;
use Illuminate\Auth\Access\HandlesAuthorization;
use Vizir\KeycloakWebGuard\Models\KeycloakUser;

class UnidadePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Vizir\KeycloakWebGuard\Models\KeycloakUser  $keycloakUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(KeycloakUser $keycloakUser)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Vizir\KeycloakWebGuard\Models\KeycloakUser  $keycloakUser
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(KeycloakUser $keycloakUser, Unidade $unidade)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Vizir\KeycloakWebGuard\Models\KeycloakUser  $keycloakUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(KeycloakUser $keycloakUser)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Vizir\KeycloakWebGuard\Models\KeycloakUser  $keycloakUser
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(KeycloakUser $keycloakUser, Unidade $unidade)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Vizir\KeycloakWebGuard\Models\KeycloakUser  $keycloakUser
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(KeycloakUser $keycloakUser, Unidade $unidade)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Vizir\KeycloakWebGuard\Models\KeycloakUser  $keycloakUser
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(KeycloakUser $keycloakUser, Unidade $unidade)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Vizir\KeycloakWebGuard\Models\KeycloakUser  $keycloakUser
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(KeycloakUser $keycloakUser, Unidade $unidade)
    {
        //
    }
}
