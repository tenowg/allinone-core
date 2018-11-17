<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EveSSO\CharacterPublic;
use EveSSO\EveSSO;
use App\Traits\Permissions;
use App\User;

class CharacterController extends Controller
{
    use Permissions;

    public function getCharacterPublic(CharacterPublic $character) {
        return $character;
    }

    public function getCharacterProfile(CharacterPublic $character) {
        $user = \Auth::user();
        $profile_user = User::whereCharacterId($character->character_id)->first();

        // Return values
        $char = new \stdClass();

        if ($user) {
            if ($user->can('viewStats', $character)) {
                $character->load('stats');
            }
            if ($this->hasPermission($user, 'hasAdminRights')) {
                // if profile belongs to an active user
                if ($profile_user && $this->hasPermission($user, 'viewPermissionGroup')) {
                    $profile_user->load(['permissions' => function($q) {
                        $q->join('permissions', 'user_permissions.perm_id', '=', 'permissions.id');
                    }]);
                }
            }
        }

        $return = new \stdClass();
        $return->char = $character;
        $return->user = $profile_user;
        return \Response::json($return);
    }
}
