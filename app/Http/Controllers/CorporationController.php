<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EveSSO\CorporationPublic;

class CorporationController extends Controller
{
    public function getCorporations() {
        return CorporationPublic::all()->toArray();
    }

    public function getCorporationPublic(CorporationPublic $corp) {
        return $corp;
    }
}
