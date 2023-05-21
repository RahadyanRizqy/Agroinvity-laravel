<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function session($session) {
        if ($session == 1) {
            return view('usersession/login');
        } else {
            return view('usersession/register');
        }
    }
}
