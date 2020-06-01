@extends('teacher.teacher')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <table v-if="!stu_id" class="table table-striped table-bordered table-hover table-condensed">
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
                <select class="form-control" v-model="reshte_id" @change="get_lesson_teacher()">
                    <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">درس</label>
                <select class="form-control" v-model="lesson_id">
                    <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                </select>
            </div>
        </div>
        <div v-if="!stu_id" class="col-md-3 right list_button_insert">
            <button style="margin-top: 42px;display:inline-block;" type="button" class="btn btn_borhan" @click="report_stu_teacher()">گزارش </button>
            <export-excel :data="all_stu" style="display: inline-block;" :fields="json_fields" name="students_file">
                <button style="margin-top: 42px;display:inline-block;" type="button" class="btn btn-success">
                    <i class="fas fa-file-excel"></i>
                    اکسل </button>
            </export-excel>
        </div>
        <thead>
            <th>ردیف</th>
            <th>دانش آموز</th>
            <th>کد ملی</th>
            <!-- <th>تاریخ تولد</th> -->
            <th>آخرین معدل</th>
        </thead>
        <tbody>
            <tr v-for="(stu, index) in all_stu">
                <td>@{{index+1}}</td>
                <td>@{{stu.name}}</td>
                <td>@{{stu.username}}</td>
                <!-- <td>@{{stu.birthday}}</td> -->
                <td>@{{stu.last_avg}}</td>
            </tr>
        </tbody>
    </table>


</div>

@endsection