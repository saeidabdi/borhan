<?php

namespace App\Http\Controllers;

use App\Stu;
use Session;
use Illuminate\Http\Request;

class StuController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $pass = $request->pass;

        $logined = Stu::where('username', $username)->where('pass', $pass)->first();

        if ($logined) {
            Session::put('username', $username);
            return $logined;
        }
    }

    public function index()
    {
        return view('stu.index');
    }

    public function getstu()
    {
        $username = Session::get('username');
        $user = Stu::where('username', $username)->first();
        return $user;
    }
}
