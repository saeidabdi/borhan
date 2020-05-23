@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5 all_content">
    <div class="col-md-12 all_pro right">
        <div class="col-md-6" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b col-md-4">کلمه عبور </label>
            <input class="form-control cl_in_b col-md-7" type="text" v-model="pass">
        </div>
        <div class="col-md-6" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b col-md-4">کلمه عبور جدید </label>
            <input class="form-control cl_in_b col-md-7" type="password" v-model="new_pass">
        </div>
        <div class="col-md-6" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b col-md-4">تکرار کلمه عبور جدید</label>
            <input class="form-control cl_in_b col-md-7" type="password" v-model="new_pass2">
        </div>
        <div class="col-md-6" style="text-align: right;margin-top:20px;box-sizing: border-box;">
        <div class="label label-default cl_in_b col-md-4"></div>
            <button type="button" class="btn btn-danger form-control cl_in_b col-md-7" @click="edit_pass_user()">تغییر کلمه عبور</button>
        </div>
    </div>
</div>
@endsection