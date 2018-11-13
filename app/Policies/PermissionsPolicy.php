<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\Permissions;

class PermissionsPolicy
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

    public function before($user, $ability) {
        return $this->hasPermission($user, 'superUser');
    }

    public function view(User $user) {
        return $this->hasPermission($user, 'viewPermissionGroup');
    }
}
