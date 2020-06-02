<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function get_branch_admin(Request $request){
        $branch = Branch::find($request->id);

        return $branch;
    }

    public function film(){
        return view('admin.film');
    }

    public function reportstu(){
        return view('admin.reportstu');
    }

    public function report(){
        return view('admin.report');
    }

    public function pass(){
        return view('admin.pass');
    }

    public function exam(){
        return view('admin.exam');
    }
}
