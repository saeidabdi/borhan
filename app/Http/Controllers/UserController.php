<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Branch;
use Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $pass = $request->pass;

        $logined = User::where('username', $username)->where('pass', $pass)->first();

        if ($logined) {
            Session::put('username', $username);
            return $logined;
        }
    }

    public function index()
    {
        return view('user.index');
    }

    public function getuser()
    {
        $username = Session::get('username');
        $user = User::where('username', $username)->first();
        return $user;
    }

    public function branch()
    {
        return view('user.branch');
    }

    public function add_branch(Request $request)
    {
        $new_branch = new Branch;
        $new_branch->name = $request->name;
        $new_branch->addr = $request->addr;
        $new_branch->type = $request->type;

        if ($new_branch->save()) {
                return response()->json(['mes' => 'شعبه جدید ایجاد شد']);
        }
    }

    public function get_branch()
    {
        $all_branch = Branch::all();
        return $all_branch;
    }
}
