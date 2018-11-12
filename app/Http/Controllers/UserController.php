<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getCurrentUser() {
        if (\Auth::check()) {
            return \Auth::user();
        }
        return 'user not found';
    }
}
