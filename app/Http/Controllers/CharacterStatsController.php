<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EveSSO\EveSSO;

class CharacterStatsController extends Controller
{
    public function getStats(EveSSO $sso) {
        return $sso->stats;
    }
}
