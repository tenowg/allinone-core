<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EveSSO\AlliancePublic;

class AllianceController extends Controller
{
    public function getAlliances() {
        return AlliancePublic::all()->toArray();
    }

    public function getAlliancePublic(AlliancePublic $alliance) {
        return $alliance;
    }
}
