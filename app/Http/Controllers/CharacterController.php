<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EveSSO\CharacterPublic;
use EveSSO\EveSSO;
use App\Traits\Permissions;

class CharacterController extends Controller
{
    use Permissions;

    public function getCharacterPublic(CharacterPublic $character) {
        return $character;
    }

    public function getCharacterProfile(CharacterPublic $character) {
        $user = \Auth::user();

        if ($user) {
            if ($user->can('viewStats', $character)) {
                $character->load('stats');
            }
        }
        return $character;
    }
}
