@extends('stu.stu')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5 all_content">
    <div v-if="gender ==0 || gender==1" class="stu_icon_p">
        <img v-if="gender==0" class="stu_icon" src="/as/images/graduate-student-avatar.png" alt="عکس دانش آموز">
        <img v-if="gender==1" class="stu_icon" src="/as/images/graduate2.png" alt="عکس دانش آموز">
    </div>
    <div class="col-md-12 all_pro right">
        <div class="stu_name">
            <h1>@{{name}}</h1>
        </div>
        <div class="col-md-4 cl_in_b right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b col-md-2">پایه </label>
            <input class="form-control cl_in_b col-md-8" disabled type="text" v-model="paye_name">
        </div>
        <div class="col-md-4 cl_in_b right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b col-md-2">رشته </label>
            <input class="form-control cl_in_b col-md-8" disabled type="text" v-model="reshte_name">
        </div>
        <div class="col-md-4 cl_in_b right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b col-md-3">نام کاربری </label>
            <input class="form-control cl_in_b col-md-8" disabled type="text" v-model="username">
        </div>
        <div class="col-md-4 cl_in_b2 right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b">مدرسه : @{{school_name}}</label>
        </div>
        <div class="col-md-4 cl_in_b2 right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b">تاریخ تولد : @{{birthday}}</label>
        </div>
        <div class="col-md-4 cl_in_b2 right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b">آخرین معدل : @{{last_avg}}</label>
        </div>
        <div class="col-md-12 cl_in_b2 right" style="text-align: right;margin-top:20px;box-sizing: border-box;">
            <label class="label label-default cl_in_b">آدرس منزل : @{{addr_stu}}</label>
        </div>
        <hr class="col-md-12 right" style="padding-right: 0!important;">
        <h4 class="col-md-12 right" style="color:#555">شماره های تماس : </h4>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره منزل : @{{phone_home}}</label>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره پدر : @{{phone_father}}</label>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره مادر : @{{phone_mother}}</label>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره دانش آموز : @{{phone_stu}}</label>
            </div>
        </div>
    </div>
</div>
@endsection