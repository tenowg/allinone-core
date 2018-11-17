<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getCurrentUser() {
        if (\Auth::check()) {
            return \Auth::user();
        }
        return 'user not found';
    }

    public function getUsers() {
        return User::all();
    }
}
