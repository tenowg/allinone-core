<?php

namespace App\Policies;

use App\User;
use EveSSO\CorporationPublic;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permissions\GrantedPermission;
use App\Traits\Permissions;

class CorporationPolicy
{
    use HandlesAuthorization, Permissions;

    public function before($user, $ability) {
        return $this->hasPermission($user, 'superUser');
    }
    
    /**
     * Determine whether the user can view the corporation public.
     *
     * @param  \App\User  $user
     * @param  EveSSO\CorporationPublic  $corporationPublic
     * @return mixed
     */
    public function view(User $user, CorporationPublic $corporationPublic)
    {
        if ($user->sso->characterPublic->corporation_id === $corporationPublic->corporation_id) {
            return $this->hasPermission($user, 'viewOwnCorporation');
        } else {
            return $this->hasPermission($user, 'viewOtherCorporation');
        }
    }

     /**
     * Determine whether the user can join the corporation public channel.
     *
     * @param  \App\User  $user
     * @param  EveSSO\CorporationPublic  $corporationPublic
     * @return mixed
     */
    public function join(User $user, CorporationPublic $corporationPublic)
    {
        if ($user->sso->characterPublic->corporation_id === $corporationPublic->corporation_id) {
            return $this->hasPermission($user, 'joinOwnCorporation');
        } else {
            return $this->hasPermission($user, 'joinOtherCorporation');
        }
    }

    /**
     * Determine whether the user can delete the corporation public.
     *
     * @param  \App\User  $user
     * @param  EveSSO\CorporationPublic  $corporationPublic
     * @return mixed
     */
    public function delete(User $user, CorporationPublic $corporationPublic)
    {
        //
    }
}
