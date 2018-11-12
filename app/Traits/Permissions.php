<?php

namespace App\Traits;

use App\User;


trait Permissions {
    public function hasPermission(User $user, string $permission) {
        $test = \App\User::whereHas('permissions', function($q) use ($permission) {
            $q->whereHas('permissions', function($q2) use ($permission) {
                $q2->whereHas('granted', function($q3) use ($permission) { 
                    $q3->where('permission', '=', $permission);
                });
            });
        })->where('id', '=', $user->id)->first();

        return $test ? true : false;
    }
}