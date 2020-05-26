@extends('teacher.teacher')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <table class="table table-striped table-bordered table-hover table-condensed">
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شعبه</label>
                <select class="form-control" v-model="branch_id" @change="get_paye_teacher(teacher_id,2)">
                    <option v-for="branch in all_branch" :value="branch.id">@{{branch.name}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">پایه</label>
                <select class="form-control" v-model="paye_id" @change="change_paye(2)">
                    <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                </select>
            </div>
        </div>
        <div v-if="with_reshte" class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">وضعیت درس</label>
                <select class="form-control" v-model="branch_type" @change="()=>{get_reshte_teacher();}">
                    <option value="0">عمومی</option>
                    <option value="1">تخصصی</option>
                </select>
            </div>
        </div>
        <div v-if="with_reshte && branch_type==1" class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">رشته</label>
                <select class="form-control" v-model="reshte_id" @change="get_lesson_teacher()()">
                    <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">درس</label>
                <select class="form-control" v-model="lesson_id" @change="get_film()">
                    <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">فیلم</label>
                <select class="form-control" v-model="film_id">
                    <option v-for="film in all_film" :value="film.id">@{{film.title}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 right list_button_insert">
            <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="report_absent()">گزارش حضور</button>
        </div>
        <thead>
            <th>ردیف</th>
            <th>دانش آموز</th>
            <th>نام کاربری</th>
            <th>زمان شروع</th>
            <th>زمان پایان</th>
            <th>مدت حضور</th>
        </thead>
        <tbody>
            <tr v-for="absent in all_absent">
                <td>@{{absent.id}}</td>
                <td>@{{absent.name}}</td>
                <td>@{{absent.username}}</td>
                <td>@{{absent.open_time}}</td>
                <td>@{{absent.close_time}}</td>
                <td>@{{(absent.extra/60).toString().substring(0,4)}} دقیقه</td>
            </tr>
        </tbody>

    </table>
</div>

@endsection