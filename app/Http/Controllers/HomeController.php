<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->where('pass', $request->pass)->first();

        if ($user) {
            Session::put('username', $request->username);
            return $user;
        }
    }

    public function getuser()
    {
        $username = Session::get('username');
        $user = User::where('username', $username)->first();
        return $user;
    }
}
