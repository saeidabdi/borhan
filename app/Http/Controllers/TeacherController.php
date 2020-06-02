<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Lesson;
use App\Paye;
use App\Reshte;
use App\Teacher;
use App\TeacherManage;
use App\StuManagement;
use App\Stu;
use Session;
use DB;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $pass = $request->pass;

        $logined = Teacher::where('username', $username)->where('pass', $pass)->first();

        if ($logined) {
            Session::put('username', $username);
            return $logined;
        }
    }

    public function index()
    {
        return view('teacher.index');
    }

    public function getteach()
    {
        $username = Session::get('username');
        $user = Teacher::where('username', $username)->first();
        return $user;
    }

    public function get_paye_teacher(Request $request)
    {
        if ($request->branch_id) {
            $paye_ids = TeacherManage::where('t_id', $request->id)->where('b_id', $request->branch_id)->groupBy('p_id')->select('p_id')->get();
        } else {
            $paye_ids = TeacherManage::where('t_id', $request->id)->groupBy('p_id')->select('p_id')->get();
        }
        $ids = array();
        foreach ($paye_ids as $key => $value) {
            array_push($ids, $value->p_id);
        }

        $payes = Paye::whereIn('id', $ids)->get();
        return $payes;
    }

    public function get_lesson_teacher(Request $request)
    {
        $lesson_ids = TeacherManage::where('t_id', $request->id)->where('p_id', $request->paye_id)->where('r_id', $request->reshte_id)->groupBy('l_id')->select('l_id')->get();
        $ids = array();

        foreach ($lesson_ids as $key => $value) {
            array_push($ids, $value->l_id);
        }

        $lesson = Lesson::whereIn('id', $ids)->get();
        return $lesson;
    }

    public function get_reshte_teacher(Request $request)
    {
        $reshte_ids = TeacherManage::where('t_id', $request->id)->where('p_id', $request->paye_id)->groupBy('r_id')->select('r_id')->get();
        $ids = array();

        foreach ($reshte_ids as $key => $value) {
            array_push($ids, $value->r_id);
        }

        $reshte = Reshte::whereIn('id', $ids)->get();
        return $reshte;
    }

    public function profile()
    {
        return view('teacher.profile');
    }

    public function dars()
    {
        return view('teacher.dars');
    }

    public function get_branch_teacher(Request $request)
    {
        $reshte_ids = TeacherManage::where('t_id', $request->id)->groupBy('b_id')->select('b_id')->get();
        $ids = array();

        foreach ($reshte_ids as $key => $value) {
            array_push($ids, $value->b_id);
        }

        $reshte = Branch::whereIn('id', $ids)->get();
        return $reshte;
    }

    public function pass()
    {
        return view('teacher.pass');
    }

    public function edit_pass_teacher(Request $request)
    {
        $stu = Teacher::where('id', $request->stu_id)
            ->where('pass', $request->pass)
            ->first();

        if ($stu) {
            $stu->pass = $request->new_pass;
            if ($stu->update()) {
                return response()->json(['mes' => 'کلمه عبور بروزرسانی شد']);
            }
        } else {
            return response()->json(['mes' => 'کلمه عبور اشتباه است']);
        }
    }

    public function plan()
    {
        return view('teacher.plan');
    }

    public function reportstu()
    {
        return view('teacher.reportstu');
    }

    public function report_stu_teacher(Request $request)
    {
        $b_id = $request->b_id;
        $p_id = $request->p_id;
        $r_id = $request->r_id;
        $l_id = $request->l_id;
        $t_id = $request->t_id;


        $count_lesson = StuManagement::where('b_id', $request->b_id)->where('l_id', $l_id)->groupBy('s_id')->select('s_id', DB::raw('count(*) as total'))->get();

        
        $ids = array();
        foreach ($count_lesson as $k => $v) {
            array_push($ids, $v->s_id);
        }

        if ($r_id) {
            $stu = Stu::whereIn('id', $ids)->where('p_id', $request->p_id)->where('r_id', $request->r_id)->select('id', 'name', 'school', 'addr', 'last_avg', 'username')->get();
        } else {
            $stu = Stu::whereIn('id', $ids)->where('p_id', $request->p_id)->select('id', 'name', 'school', 'addr', 'last_avg', 'username')->get();
        }

        return $stu;
    }

    public function exam()
    {
        return view('teacher.exam');
    }
}
