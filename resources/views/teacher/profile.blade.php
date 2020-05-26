@extends('teacher.teacher')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5 all_content">
    <div class="stu_icon_p">
        <img class="stu_icon" src="/as/images/graduate-student-avatar.png" alt="عکس معلم">
    </div>
    <div class="col-md-12 all_pro right">
        <div class="stu_name">
            <h1>@{{name}}</h1>
        </div>
        <div class="col-md-4 cl_in_b right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b col-md-3">نام کاربری </label>
            <input class="form-control cl_in_b col-md-8" disabled type="text" v-model="username">
        </div>
    </div>
</div>
@endsection