<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Lesson;
use App\Stu;
use App\StuManagement;
use App\TeacherManage;
use App\views_film;
use Session;
use DB;
use Illuminate\Http\Request;

class StuController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $pass = $request->pass;

        $logined = Stu::where('username', $username)->where('pass', $pass)->first();

        if ($logined) {
            if ($logined->active == 0) {
                $stu = Stu::where('username', $username)->where('pass', $pass)->update([
                    'active' => 1
                ]);
            }
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

    public function get_branch_stu(Request $request)
    {
        $count_branch = StuManagement::where('s_id', $request->id)->groupBy('b_id')->select('b_id', DB::raw('count(*) as total'))->get();

        if (count($count_branch) == 1) {
            $lesson = DB::table('stu_management')
                ->where('stu_management.s_id', $request->id)
                ->leftJoin('lesson', 'stu_management.l_id', '=', 'lesson.id')
                ->select('lesson.*')
                ->get();
            if (count($lesson) == 1) {
                // شرط فهمیدن دروس برای مدرسه
                if ($lesson[0]->l_id == 0) {
                    $lesson = Lesson::where('p_id', $request->p_id)->where('r_id', $request->r_id)->get();
                    return response()->json(['lesson' => $lesson, 'mes' => 'شعبه بروزرسانی شد', 'status' => 1]);
                } else {
                    return response()->json(['lesson' => $lesson, 'mes' => 'شعبه بروزرسانی شد', 'status' => 1]);
                }
            } else {
                return response()->json(['lesson' => $lesson, 'mes' => 'شعبه بروزرسانی شد', 'status' => 1]);
            }
            // get lessson
        } else {
            $ids = array();
            foreach ($count_branch as $key => $value) {
                array_push($ids, $value->b_id);
            }
            $branch = Branch::whereIn('id', $ids)->get();
            return response()->json(['branch' => $branch, 'mes' => 'شعبه بروزرسانی شد', 'status' => 0]);
        }
    }

    public function show_dars(Request $request)
    {
        if ($request->type == 0) {
            $lesson = Lesson::where('p_id', $request->p_id)->where('r_id', $request->r_id)->get();
        } else {

            $lesson = DB::table('stu_management')
                ->where('stu_management.s_id', $request->s_id)
                ->where('stu_management.b_id', $request->b_id)
                ->leftJoin('lesson', 'stu_management.l_id', '=', 'lesson.id')
                ->select('lesson.*')
                ->get();
        }


        return response()->json(['lesson' => $lesson, 'mes' => 'شعبه بروزرسانی شد', 'status' => 1]);
    }

    public function show_film(Request $request)
    {
        $teacher = TeacherManage::where('b_id', $request->b_id)->where('p_id', $request->p_id)->where('r_id', $request->r_id)->where('l_id', $request->l_id)->first();
        // return $teacher->t_id;
        if ($teacher && $teacher->t_id) {
            $film = DB::table('film')
                ->where('film.l_id', $request->l_id)
                ->where('film.t_id', $teacher->t_id)
                ->leftJoin('film_branch', 'film.id', '=', 'film_branch.film_id')
                ->where('film_branch.b_id', $teacher->b_id)
                // ->select('lesson.*')
                ->get();
        } else {
            $film = 0;
        }

        return response()->json(['film' => $film, 'mes' => 'شعبه بروزرسانی شد', 'status' => 1]);
    }

    public function play_film(Request $request)
    {
        $film = DB::table('film')
            ->where('id', $request->film_id)
            ->first();
        $view_film = new views_film;
        $view_film->film_id = $request->film_id;
        $view_film->stu_id = $request->stu_id;
        $view_film->b_id = $request->b_id;
        $view_film->open_time = time();
        if ($view_film->save()) {
            return response()->json(['film' => $film, 'mes' => 'شعبه بروزرسانی شد', 'status' => 1, 'view_id' => $view_film->id]);
        }
    }

    public function lesson()
    {
        return redirect('/stu/index');
    }
    public function film()
    {
        return redirect('/stu/index');
    }
    public function play_a_film()
    {
        return redirect('/stu/index');
    }

    public function onEnd(Request $request)
    {;
        $view_film = DB::table('views_film')->where('id', $request->view_id)->update([
            'close_time' => time()
        ]);
    }

    // profile
    public function profile()
    {
        return view('stu.profile');
    }
    public function get_profile_stu(Request $request)
    {
        $stu = DB::table('stu')
        ->where('stu.id', $request->id)
        ->leftJoin('paye', 'stu.p_id', '=', 'paye.id')
        ->leftJoin('reshte', 'stu.r_id', '=', 'reshte.id')
        ->leftJoin('phone', 'stu.id', '=', 'phone.stu_id')
        ->select('stu.*','phone.*','paye.title as p_title','reshte.title as r_title')
        ->get();

        return $stu;
    }

    // pass
    public function pass()
    {
        return view('stu.pass');
    }

    public function edit_pass(Request $request)
    {
        $stu = Stu::
        where('id', $request->stu_id)
        ->where('pass', $request->pass)
        ->first();

        if($stu){
            $stu->pass = $request->new_pass;
            if($stu->update()){
                return response()->json(['mes' => 'کلمه عبور بروزرسانی شد']);
            }
        }else{
            return response()->json(['mes' => 'کلمه عبور اشتباه است']);
        }
    }
}
