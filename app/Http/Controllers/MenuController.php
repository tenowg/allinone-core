<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MenuViewModels\Menu;

class MenuController extends Controller
{
    public function generateMenu(Menu $menu) {
        return response()->json($menu);      
    }
}

