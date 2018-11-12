<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use EveSSO\CharacterPublic;
use App\Traits\Permissions;

class CharacterPolicy
{
    use HandlesAuthorization, Permissions;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewStats(User $user, CharacterPublic $public) {
        if ($user->sso->character_id === $public->character_id) {
            return $this->hasPermission($user, 'viewOwnStats');
        } else {
            return $this->hasPermission($user, 'viewOtherStats');
        }
    }

    public function viewProfile(User $user, CharacterPublic $public) {
        if ($user->sso->character_id === $public->character_id) {
            return $this->hasPermission($user, 'viewOwnProfile');
        } else {
            return $this->hasPermission($user, 'viewOtherProfile');
        }
    }
}
