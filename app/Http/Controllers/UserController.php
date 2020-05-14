<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Branch;
use App\Film;
use App\Lesson;
use App\Paye;
use App\Reshte;
use App\Special_film;
use App\Stu;
use App\StuManagement;
use App\Teacher;
use App\TeacherManage;
use DB;
use Illuminate\Support\Facades\Validator;
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
        $id = $request->id;
        if ($id) {
            $new_branch = Branch::where('id', $id)->first();
            $new_branch->name = $request->name;
            $new_branch->addr = $request->addr;
            $new_branch->type = $request->type;

            if ($new_branch->update()) {
                return response()->json(['mes' => 'شعبه بروزرسانی شد']);
            }
        } else {
            $new_branch = new Branch;
            $new_branch->name = $request->name;
            $new_branch->addr = $request->addr;
            $new_branch->type = $request->type;

            if ($new_branch->save()) {
                return response()->json(['mes' => 'شعبه جدید ایجاد شد']);
            }
        }
    }

    public function get_branch()
    {
        $all_branch = Branch::all();
        return $all_branch;
    }

    public function delete_branch(Request $request)
    {
        if (Branch::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'شعبه با موفقیت حذف شد.']);
        }
    }
    // *paye
    public function paye()
    {
        return view('user.paye');
    }

    public function add_paye(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $new_paye = Paye::where('id', $id)->first();
            $new_paye->title = $request->title;
            $new_paye->type = $request->type;

            if ($new_paye->update()) {
                return response()->json(['mes' => 'پایه بروزرسانی شد']);
            }
        } else {
            $new_paye = new Paye;
            $new_paye->title = $request->title;
            $new_paye->type = $request->type;

            if ($new_paye->save()) {
                return response()->json(['mes' => 'پایه جدید ایجاد شد']);
            }
        }
    }

    public function get_paye()
    {
        $all_paye = Paye::all();
        return $all_paye;
    }

    public function delete_paye(Request $request)
    {
        if (Paye::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'پایه با موفقیت حذف شد']);
        }
    }
    //  رشته
    public function reshte()
    {
        return view('user.reshte');
    }

    public function add_reshte(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $new_reshte = Reshte::where('id', $id)->first();
            $new_reshte->title = $request->title;

            if ($new_reshte->update()) {
                return response()->json(['mes' => 'رشته بروزرسانی شد']);
            }
        } else {
            $new_reshte = new Reshte;
            $new_reshte->title = $request->title;

            if ($new_reshte->save()) {
                return response()->json(['mes' => 'رشته جدید ایجاد شد']);
            }
        }
    }

    public function get_reshte()
    {
        $all_paye = Reshte::all();
        return $all_paye;
    }

    public function delete_reshte(Request $request)
    {
        if (Reshte::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'رشته با موفقیت حذف شد']);
        }
    }
    //  دروس
    public function dars()
    {
        return view('user.dars');
    }

    public function add_lesson(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $new_lesson = Lesson::where('id', $id)->first();
            $new_lesson->name = $request->name;
            $new_lesson->status = $request->status;
            $new_lesson->p_id = $request->paye_id;
            $new_lesson->r_id = $request->reshte_id;

            if ($new_lesson->update()) {
                return response()->json(['mes' => 'درس بروزرسانی شد']);
            }
        } else {
            $new_lesson = new Lesson;
            $new_lesson->name = $request->name;
            $new_lesson->status = $request->status;
            $new_lesson->p_id = $request->paye_id;
            $new_lesson->r_id = $request->reshte_id;

            if ($new_lesson->save()) {
                return response()->json(['mes' => 'درس جدید ایجاد شد']);
            }
        }
    }

    public function get_lesson(Request $request)
    {
        $p_id = $request->paye_id;
        $status = $request->status;
        $r_id = $request->reshte_id;
        if (!$r_id) {
            $all_lesson = Lesson::where('p_id', $p_id)->where('r_id', $r_id)->where('status', $status)->get();
            return $all_lesson;
        } else {
            $all_lesson = Lesson::where('p_id', $p_id)->where('r_id', $r_id)->where('status', $status)->get();
            return $all_lesson;
        }
    }

    public function delete_lesson(Request $request)
    {
        if (Lesson::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'درس با موفقیت حذف شد']);
        }
    }
    //  معلم
    public function teacher()
    {
        return view('user.teacher');
    }

    public function add_teacher(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $new_teacher = Teacher::where('id', $id)->first();
            $new_teacher->name = $request->name;
            $new_teacher->username = $request->username;
            $new_teacher->pass = $request->pass;

            if ($new_teacher->update()) {
                return response()->json(['mes' => 'معلم بروزرسانی شد']);
            }
        } else {
            $new_teacher = new Teacher;
            $new_teacher->name = $request->name;
            $new_teacher->username = $request->username;
            $new_teacher->pass = $request->pass;

            if ($new_teacher->save()) {
                return response()->json(['mes' => 'معلم جدید ایجاد شد', 'id' => $new_teacher->id]);
            }
        }
    }

    public function give_class_toteacher(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $new_t_c = TeacherManage::where('id', $id)->first();
            $new_t_c->t_id = $request->t_id;
            $new_t_c->b_id = $request->b_id;
            $new_t_c->p_id = $request->p_id;
            $new_t_c->r_id = $request->r_id;
            $new_t_c->l_id = $request->l_id;

            if ($new_t_c->update()) {
                return response()->json(['mes' => 'معلم درس بروزرسانی شد']);
            }
        } else {
            $new_t_c = new TeacherManage;
            $new_t_c->t_id = $request->t_id;
            $new_t_c->b_id = $request->b_id;
            $new_t_c->p_id = $request->p_id;
            $new_t_c->r_id = $request->r_id;
            $new_t_c->l_id = $request->l_id;

            if ($new_t_c->save()) {
                return response()->json(['mes' => 'معلم درس انتخاب شد']);
            }
        }
    }

    public function get_teacher_class(Request $request)
    {

        $get_class_teacher = DB::table('teacher_management')
            ->where('teacher_management.t_id', $request->t_id)
            ->leftJoin('branch', 'teacher_management.b_id', '=', 'branch.id')
            ->leftJoin('paye', 'teacher_management.p_id', '=', 'paye.id')
            ->leftJoin('reshte', 'teacher_management.r_id', '=', 'reshte.id')
            ->leftJoin('lesson', 'teacher_management.l_id', '=', 'lesson.id')
            ->select('teacher_management.id', 'branch.name as b_name', 'paye.title as p_name', 'reshte.title as r_name', 'lesson.name as l_name')
            ->get();

        return $get_class_teacher;
    }

    public function delete_teacher_class(Request $request)
    {
        if (TeacherManage::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'درس با موفقیت حذف شد']);
        }
    }

    public function get_teacher()
    {
        $all_paye = Teacher::all();
        return $all_paye;
    }

    public function delete_teacher(Request $request)
    {
        if (Teacher::where('id', $request->id)->delete()) {
            if (TeacherManage::where('t_id', $request->id)->delete()) {
                return response()->json(['success' => 'معلم با موفقیت حذف شد']);
            }
        }
    }
    //  دانش آموز
    public function stu()
    {
        return view('user.stu');
    }

    public function add_stu(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $new_stu = Stu::where('id', $id)->first();
            $new_stu->name = $request->name;
            $new_stu->username = $request->username;
            $new_stu->pass = $request->pass;
            $new_stu->p_id = $request->p_id;
            $new_stu->r_id = $request->r_id;

            if ($new_stu->update()) {
                return response()->json(['mes' => 'دانش آموز بروزرسانی شد']);
            }
        } else {
            $new_stu = new Stu;
            $new_stu->name = $request->name;
            $new_stu->username = $request->username;
            $new_stu->pass = $request->pass;
            $new_stu->p_id = $request->p_id;
            $new_stu->r_id = $request->r_id;

            if ($new_stu->save()) {
                return response()->json(['mes' => 'دانش آموز جدید ایجاد شد', 'id' => $new_stu->id]);
            }
        }
    }

    public function get_lesson_stu(Request $request)
    {
        $p_id = $request->paye_id;
        $r_id = $request->reshte_id;

        $all_lesson = Lesson::where('p_id', $p_id)->where('r_id', $r_id)->get();
        return $all_lesson;
    }

    public function give_class_tostu(Request $request)
    {
        $new_t_c = new StuManagement;
        $new_t_c->s_id = $request->s_id;
        $new_t_c->b_id = $request->b_id;
        if ($request->l_id) {
            $new_t_c->l_id = $request->l_id;
        } else {
            $new_t_c->l_id = 0;
        }


        if ($new_t_c->save()) {
            return response()->json(['mes' => 'درس به برنامه دنش آموز اضافه شد']);
        }
    }

    public function get_stu_class(Request $request)
    {

        $get_stu_class = DB::table('stu_management')
            ->where('stu_management.s_id', $request->s_id)
            ->leftJoin('branch', 'stu_management.b_id', '=', 'branch.id')
            ->leftJoin('lesson', 'stu_management.l_id', '=', 'lesson.id')
            ->select('stu_management.id', 'branch.name as b_name', 'lesson.name as l_name')
            ->get();

        return $get_stu_class;
    }

    public function stu_teacher_class(Request $request)
    {
        if (StuManagement::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'درس با موفقیت حذف شد']);
        }
    }

    public function get_stu()
    {
        $all_paye = Stu::all();
        return $all_paye;
    }

    public function delete_stu(Request $request)
    {
        if (Stu::where('id', $request->id)->delete()) {
            if (StuManagement::where('s_id', $request->id)->delete()) {
                return response()->json(['success' => 'دانش آموز با موفقیت حذف شد']);
            }
        }
    }
    //  فیلم
    public function film()
    {
        return view('user.film');
    }

    public function change_lesson(Request $request)
    {
        $teachers = DB::table('teacher_management')
        ->where('teacher_management.l_id', $request->l_id)
        ->distinct('teacher_management.t_id')
        ->leftJoin('teacher', 'teacher_management.t_id', '=', 'teacher.id')
        ->select('teacher.id','teacher.name')
        ->get();

        return $teachers;
    }

    public function formSubmit(Request $request)
    {
        ini_set("memory_limit", "500000");
        ini_set('post_max_size', '500000');
        ini_set('upload_max_filesize', '500000');
        // $validator = Validator::make($request->all(), [
        //     'file' => 'max:500000', //5MB 
        // ]);
    	$imageName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('images'), $imageName);
         
    	return response()->json($imageName);
    }

    public function add_film(Request $request)
    {
        $special_film = DB::table('teacher_management')
        ->where('t_id',$request->t_id)
        ->where('l_id',$request->l_id)
        ->leftJoin('branch', 'teacher_management.b_id', '=', 'branch.id')
        ->leftJoin('paye', 'teacher_management.p_id', '=', 'paye.id')
        ->leftJoin('reshte', 'teacher_management.r_id', '=', 'reshte.id')
        ->leftJoin('lesson', 'teacher_management.l_id', '=', 'lesson.id')
        ->select('teacher_management.id', 'branch.name as b_name', 'paye.title as p_name', 'reshte.title as r_name', 'lesson.name as l_name', 'branch.id as b_id')
        ->get();
        $id = $request->id;
        if ($id) {
            $new_film = Teacher::where('id', $id)->first();
            $new_film->title = $request->title;
            $new_film->addr = $request->addr;
            $new_film->l_id = $request->l_id;
            $new_film->t_id = $request->t_id;

            if ($new_film->update()) {
                return response()->json(['mes' => 'فیلم بروزرسانی شد']);
            }
        } else {
            $new_film = new Film;
            $new_film->title = $request->title;
            $new_film->addr = $request->addr;
            $new_film->l_id = $request->l_id;
            $new_film->t_id = $request->t_id;

            if ($new_film->save()) {
                return response()->json(['mes' => 'فیلم جدید ایجاد شد', 'id' => $new_film->id,'special_film'=>$special_film]);
            }
        }

    }

    public function allow_show(Request $request)
    {
        $a  = Special_film::insert([
            'film_id'=> $request->film_id,
            'b_id'=> $request->b_id,
            'tm_id'=> $request->s_id,
            'time_added'=> time(),
            'limit_time'=> $request->limit_time
        ]);
        if($a){
            return response()->json(['mes' => 'فیلم مجاز شد']);
        }
    }

    public function get_film(Request $request)
    {
        $all_paye = Film::where('l_id',$request->l_id)->where('t_id',$request->t_id)->get();
        return $all_paye;
    }

    public function delete_film(Request $request)
    {
        if (Film::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'فیلم با موفقیت حذف شد']);
        }
    }

    public function edit_filmfunc(Request $request)
    {
        $special_film = DB::table('teacher_management')
        ->where('t_id',$request->t_id)
        ->where('l_id',$request->l_id)
        ->leftJoin('branch', 'teacher_management.b_id', '=', 'branch.id')
        ->leftJoin('paye', 'teacher_management.p_id', '=', 'paye.id')
        ->leftJoin('reshte', 'teacher_management.r_id', '=', 'reshte.id')
        ->leftJoin('lesson', 'teacher_management.l_id', '=', 'lesson.id')
        ->select('teacher_management.id', 'branch.name as b_name', 'paye.title as p_name', 'reshte.title as r_name', 'lesson.name as l_name', 'branch.id as b_id')
        ->get();

        $film_branch_ids = Special_film::where('film_id',$request->id)->select('tm_id','limit_time')->get();

        $all_paye = Film::where('id',$request->id)->update([
            'title'=>$request->title
        ]);
        return response()->json(['mes' => 'فیلم بروزرسانی شد','special_film'=>$special_film,'film_branch_ids'=>$film_branch_ids]);
    }

    public function exit_user()
    {
        $exit_user = Session::forget('username');
        if ($exit_user) {
            return true;
        }
    }
}
