<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Branch;
use App\Exam;
use App\Film;
use App\Lesson;
use App\Paye;
use App\Phone;
use App\Reshte;
use App\Special_film;
use App\Stu;
use App\StuManagement;
use App\Teacher;
use App\TeacherManage;
use App\views_film;
use DB;
use Verta;
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
            if ($request->status) {
                $new_lesson->status = $request->status;
            } else {
                $new_lesson->status = 0;
            }
            $new_lesson->p_id = $request->paye_id;
            $new_lesson->r_id = $request->reshte_id;

            if ($new_lesson->update()) {
                return response()->json(['mes' => 'درس بروزرسانی شد']);
            }
        } else {
            $new_lesson = new Lesson;
            $new_lesson->name = $request->name;
            if ($request->status) {
                $new_lesson->status = $request->status;
            } else {
                $new_lesson->status = 0;
            }
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
        if ($request->status) {
            $status = $request->status;
        } else {
            $status = 0;
        }
        $r_id = $request->reshte_id;
        if (!$r_id) {
            $all_lesson = Lesson::where('p_id', $p_id)->where('status', $status)->get();
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
            $new_stu->school = $request->school;
            $new_stu->addr = $request->addr;
            $new_stu->job_father = $request->job_father;
            $new_stu->birthday = $request->birthday;
            $new_stu->gender = $request->gender;
            $new_stu->last_avg = $request->last_avg;
            $new_stu->username = $request->username;
            $new_stu->pass = $request->pass;
            $new_stu->p_id = $request->p_id;
            $new_stu->r_id = $request->r_id;

            if ($new_stu->update()) {
                $phone = Phone::where('stu_id', $id)->first();
                $phone->phone_home = $request->phone_home;
                $phone->phone_father = $request->phone_father;
                $phone->phone_mother = $request->phone_mother;
                $phone->phone_stu = $request->phone_stu;
                $phone->stu_id = $new_stu->id;
                if ($phone->update()) {
                    return response()->json(['mes' => 'دانش آموز بروزرسانی شد']);
                }
            }
        } else {
            $new_stu = new Stu;
            $new_stu->name = $request->name;
            $new_stu->school = $request->school;
            $new_stu->addr = $request->addr;
            $new_stu->job_father = $request->job_father;
            $new_stu->birthday = $request->birthday;
            $new_stu->gender = $request->gender;
            $new_stu->last_avg = $request->last_avg;
            $new_stu->username = $request->username;
            $new_stu->pass = $request->pass;
            $new_stu->p_id = $request->p_id;
            $new_stu->r_id = $request->r_id;

            if ($new_stu->save()) {
                $phone = new Phone;
                $phone->phone_home = $request->phone_home;
                $phone->phone_father = $request->phone_father;
                $phone->phone_mother = $request->phone_mother;
                $phone->phone_stu = $request->phone_stu;
                $phone->stu_id = $new_stu->id;
                if ($phone->save()) {
                    return response()->json(['mes' => 'دانش آموز جدید ایجاد شد', 'id' => $new_stu->id]);
                }
            }
        }
    }

    public function get_lesson_stu(Request $request)
    {
        $p_id = $request->paye_id;
        $r_id = $request->reshte_id;

        $all_lesson = Lesson::orWhere('r_id', $r_id)->orWhere('r_id', null)->where('p_id', $p_id)->get();
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
        $all_stu = DB::table('stu')
            ->leftJoin('phone', 'stu.id', '=', 'phone.stu_id')
            ->select('stu.*', 'phone.phone_home', 'phone.phone_father', 'phone.phone_mother', 'phone.phone_stu')
            ->limit(10)
            ->get();
        // $all_paye = Stu::all();
        return $all_stu;
    }

    public function get_stupost(Request $request)
    {
        $all_stu = DB::table('stu')
            ->where('name', 'like', '%' . $request->search_item . '%')
            ->leftJoin('phone', 'stu.id', '=', 'phone.stu_id')
            ->select('stu.*', 'phone.phone_home', 'phone.phone_father', 'phone.phone_mother', 'phone.phone_stu')
            ->limit(10)
            ->get();
        // $all_paye = Stu::all();
        return $all_stu;
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
        if ($request->b_id) {
            $teachers = DB::table('teacher_management')
                ->where('teacher_management.l_id', $request->l_id)
                ->where('teacher_management.b_id', $request->b_id)
                ->distinct('teacher_management.t_id')
                ->leftJoin('teacher', 'teacher_management.t_id', '=', 'teacher.id')
                ->select('teacher.id', 'teacher.name')
                ->get();
        } else {
            $teachers = DB::table('teacher_management')
                ->where('teacher_management.l_id', $request->l_id)
                ->distinct('teacher_management.t_id')
                ->leftJoin('teacher', 'teacher_management.t_id', '=', 'teacher.id')
                ->select('teacher.id', 'teacher.name')
                ->get();
        }

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
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('images'), $imageName);

        return response()->json($imageName);
    }

    public function add_film(Request $request)
    {
        $special_film = DB::table('teacher_management')
            ->where('t_id', $request->t_id)
            ->where('l_id', $request->l_id)
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
                return response()->json(['mes' => 'فیلم جدید ایجاد شد', 'id' => $new_film->id, 'special_film' => $special_film]);
            }
        }
    }

    public function allow_show(Request $request)
    {
        $a  = Special_film::insert([
            'film_id' => $request->film_id,
            'b_id' => $request->b_id,
            'tm_id' => $request->s_id,
            'time_added' => time(),
            'limit_time' => $request->limit_time
        ]);
        if ($a) {
            return response()->json(['mes' => 'فیلم مجاز شد']);
        }
    }

    public function get_film(Request $request)
    {
        $all_paye = Film::where('l_id', $request->l_id)->where('t_id', $request->t_id)->get();
        return $all_paye;
    }

    public function delete_film(Request $request)
    {
        $film = Film::where('id', $request->id)->first();
        if (Film::where('id', $request->id)->delete()) {
            unlink(public_path() .  '/images/' . $film->addr);
            return response()->json(['success' => 'فیلم با موفقیت حذف شد']);
        }
    }

    public function edit_filmfunc(Request $request)
    {
        $special_film = DB::table('teacher_management')
            ->where('t_id', $request->t_id)
            ->where('l_id', $request->l_id)
            ->leftJoin('branch', 'teacher_management.b_id', '=', 'branch.id')
            ->leftJoin('paye', 'teacher_management.p_id', '=', 'paye.id')
            ->leftJoin('reshte', 'teacher_management.r_id', '=', 'reshte.id')
            ->leftJoin('lesson', 'teacher_management.l_id', '=', 'lesson.id')
            ->select('teacher_management.id', 'branch.name as b_name', 'paye.title as p_name', 'reshte.title as r_name', 'lesson.name as l_name', 'branch.id as b_id')
            ->get();

        $film_branch_ids = Special_film::where('film_id', $request->id)->select('tm_id', 'limit_time')->get();

        $all_paye = Film::where('id', $request->id)->update([
            'title' => $request->title
        ]);
        return response()->json(['mes' => 'فیلم بروزرسانی شد', 'special_film' => $special_film, 'film_branch_ids' => $film_branch_ids]);
    }

    public function exit_user()
    {
        $exit_user = Session::forget('username');
        if ($exit_user) {
            return true;
        }
    }

    public function report()
    {
        return view('user.report');
    }

    public function report_absent(Request $request)
    {

        $absent = DB::table('views_film')
            ->where('views_film.film_id', $request->film_id)
            ->where('views_film.b_id', $request->b_id)
            ->leftJoin('stu', 'views_film.stu_id', '=', 'stu.id')
            ->select('views_film.*', 'stu.username', 'stu.name')
            ->get();

        foreach ($absent as $key => $value) {

            if ($absent[$key]->close_time) {
                $extra = $absent[$key]->close_time - $absent[$key]->open_time;
                $absent[$key]->extra = $extra;

                $n = Verta::createTimestamp((int) $absent[$key]->close_time);
                $absent[$key]->close_time = $n->formatDatetime();
            } else {
                $absent[$key]->extra = '';
                $absent[$key]->close_time = '';
            }


            $v = Verta::createTimestamp((int) $absent[$key]->open_time);
            $absent[$key]->open_time = $v->formatDatetime();
        }

        return $absent;
    }

    public function edit_active(Request $request)
    {

        $stu = Stu::where('id', $request->id)->update([
            'active' => $request->activ
        ]);

        return $stu;
    }
    public function pass()
    {
        return view('user.pass');
    }

    public function edit_pass(Request $request)
    {
        $stu = User::where('id', $request->stu_id)
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

    public function get_index()
    {
        $stu = Stu::count();
        $film = Film::count();
        $branch = Branch::count();
        $teacher = Teacher::count();

        // activest_teacher
        $activest_teacher = DB::table('film')
            ->groupBy('t_id')->select('t_id', DB::raw('count(*) as total'))->get();

        $max = -9999999; //will hold max val
        $found_item = []; //will hold item with max val;

        foreach ($activest_teacher as $k => $v) {
            if ($v->total > $max) {
                $max = $v->total;
                $found_item = $v;
            }
        }

        $activest_teacher = Teacher::find($found_item->t_id);

        // activest_student
        $lasttime = time() - 7 * 86400;
        $activest_student = views_film::where('open_time', '>', $lasttime)->groupBy('stu_id')->select('stu_id', DB::raw('count(*) as total'))->get();

        $max2 = -9999999; //will hold max val
        $found_item2 = []; //will hold item with max val;

        foreach ($activest_student as $k => $v) {
            if ($v->total > $max2) {
                $max2 = $v->total;
                $found_item2 = $v;
            }
        }
        $activest_student = Stu::find($found_item2->stu_id);

        return response()->json(['stu' => $stu, 'film' => $film, 'branch' => $branch, 'teacher' => $teacher, 'activest_teacher' => $activest_teacher, 'activest_student' => $activest_student]);
    }

    // reportstu

    public function reportstu()
    {
        return view('user.reportstu');
    }

    public function report_stu(Request $request)
    {
        $b_id = $request->b_id;
        $p_id = $request->p_id;
        $r_id = $request->r_id;
        $l_id = $request->l_id;
        $t_id = $request->t_id;
        $gender = $request->gender;



        $count_branch = StuManagement::where('b_id', $request->b_id)->groupBy('s_id')->select('s_id', DB::raw('count(*) as total'))->get();
        $ids = array();
        foreach ($count_branch as $k => $v) {
            array_push($ids, $v->s_id);
        }

        if ($b_id && !$p_id && !$r_id && !$l_id && !$t_id) {
            $stu = Stu::whereIn('id', $ids)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
        } elseif ($b_id && $p_id && !$r_id && !$l_id && !$t_id) {
            $stu = Stu::whereIn('id', $ids)->where('p_id', $request->p_id)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
        } elseif ($b_id && $p_id && $r_id && !$l_id && !$t_id) {
            $stu = Stu::whereIn('id', $ids)->where('p_id', $request->p_id)->where('r_id', $request->r_id)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
        } elseif ($b_id && $p_id && $l_id) {
            $count_lesson = StuManagement::where('b_id', $request->b_id)->where('l_id', $l_id)->groupBy('s_id')->select('s_id', DB::raw('count(*) as total'))->get();
            $ids = array();
            foreach ($count_lesson as $k => $v) {
                array_push($ids, $v->s_id);
            }
            if ($r_id) {
                $stu = Stu::whereIn('id', $ids)->where('p_id', $request->p_id)->where('r_id', $request->r_id)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
            } else {
                $stu = Stu::whereIn('id', $ids)->where('p_id', $request->p_id)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
            }
        } elseif (!$b_id && $p_id && !$l_id) {
            if ($r_id) {
                if ($gender == 0 || $gender == 1) {
                    $stu = Stu::where('p_id', $request->p_id)->where('r_id', $request->r_id)->where('gender', $gender)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
                } else {
                    $stu = Stu::where('p_id', $request->p_id)->where('r_id', $request->r_id)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
                }
            } else {
                if ($gender == 0 || $gender == 1) {
                    $stu = Stu::where('p_id', $request->p_id)->where('gender', $gender)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
                } else {
                    $stu = Stu::where('p_id', $request->p_id)->select('id', 'name', 'school', 'addr', 'birthday', 'last_avg', 'gender', 'username')->get();
                }
            }
        } else {
            $stu = [];
        }

        return $stu;
    }

    public function detale_stu(Request $request)
    {
        $all_stu = DB::table('stu')
            ->where('stu.id', $request->id)
            ->leftJoin('phone', 'stu.id', '=', 'phone.stu_id')
            ->leftJoin('paye', 'stu.p_id', '=', 'paye.id')
            ->leftJoin('reshte', 'stu.r_id', '=', 'reshte.id')
            ->select('stu.*', 'phone.phone_home', 'phone.phone_father', 'phone.phone_mother', 'phone.phone_stu', 'paye.title as p_title', 'reshte.title as r_title')
            ->get();

        return $all_stu;
    }

    public function admins()
    {
        return view('user.admins');
    }

    public function add_admin(Request $request)
    {
        $new_lesson = new User;
        $new_lesson->name = $request->name;
        $new_lesson->username = $request->username;
        $new_lesson->pass = $request->pass;
        $new_lesson->b_id = $request->b_id;
        $new_lesson->type = 2;

        if ($new_lesson->save()) {
            return response()->json(['mes' => 'مدیر جدید ایجاد شد']);
        }
    }

    public function get_admin()
    {
        $admins = DB::table('users')
            ->where('users.type', 2)
            ->leftJoin('branch', 'users.b_id', '=', 'branch.id')
            ->select('users.*', 'branch.name as b_name')
            ->get();

        return $admins;
    }

    public function delete_admin(Request $request)
    {
        if (User::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'مدیر با موفقیت حذف شد']);
        }
    }

    public function exam()
    {
        return view('user.exam');
    }

    public function add_exam(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $exam = Exam::where('id', $id)->first();
            $exam->title = $request->title;
            $exam->b_id = $request->b_id;
            $exam->p_id = $request->p_id;
            $exam->r_id = $request->r_id;
            $exam->l_id = $request->l_id;
            $exam->t_id = $request->t_id;

            if ($exam->update()) {
                return response()->json(['mes' => 'آزمون بروزرسانی شد', 'id' => $exam->id, 'type' => 'update']);
            }
        } else {
            $exam = new Exam;
            $exam->title = $request->title;
            $exam->b_id = $request->b_id;
            $exam->p_id = $request->p_id;
            $exam->r_id = $request->r_id;
            $exam->l_id = $request->l_id;
            $exam->t_id = $request->t_id;

            if ($exam->save()) {
                return response()->json(['mes' => 'آزمون جدید ایجاد شد', 'id' => $exam->id, 'type' => 'insert']);
            }
        }
    }

    public function add_grade(Request $request)
    {
        if ($request->edited) {
            foreach ($request->arrgrade as $key => $value) {
                DB::table('result_exam')->where('exam_id',$request->exam_id)->where('stu_id',explode(',', $value)[0])->update([
                    'grade' => explode(',', $value)[1]
                ]);
            }
            return response()->json(['mes' => 'نمرات با موفقیت بروزرسانی شد']);
        } else {
            foreach ($request->arrgrade as $key => $value) {
                DB::table('result_exam')->insert([
                    'exam_id' => $request->exam_id,
                    'stu_id' => explode(',', $value)[0],
                    'grade' => explode(',', $value)[1]
                ]);
            }
            return response()->json(['mes' => 'نمرات با موفقیت ثبت شد']);
        }
    }

    public function get_exam(Request $request)
    {
        $all_exam = Exam::where('b_id', $request->b_id)->where('p_id', $request->p_id)->where('r_id', $request->r_id)->where('l_id', $request->l_id)->where('t_id', $request->t_id)->get();
        return $all_exam;
    }

    public function delete_exam(Request $request)
    {
        if (Exam::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'آزمون با موفقیت حذف شد']);
        }
    }

    public function get_result_exam(Request $request)
    {
        $ids = DB::table('result_exam')->where('exam_id', $request->exam_id)->get();

        return $ids;
    }
}
