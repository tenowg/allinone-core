<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EveSSO\CharacterPublic;
use EveSSO\EveSSO;

class CharacterController extends Controller
{
    public function getCharacterPublic(CharacterPublic $character) {
        return $character;
    }

    public function getCharacterProfile(CharacterPublic $character) {
        return $character;
    }
}
