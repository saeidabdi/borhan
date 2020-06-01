@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul v-if="!paye_id" dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ایجاد مدیر</a>
        </li>
        <li class="nav-item" @click="get_admin(1)">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش مدیران</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">نام و نام خانوداگی</label>
                    <input type="text" class="form-control" v-model="stu_name">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">نام کاربری (کد ملی) : </label>
                    <input type="text" class="form-control" v-model="stu_user">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> کلمه عبور (کد ملی) : </label>
                    <input type="text" class="form-control" v-model="stu_pass">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">شعبه</label>
                    <select class="form-control" v-model="branch_id">
                        <option v-for="branch in all_branch" :value="branch.id">@{{branch.name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="add_admin()">ایجاد مدیر شعبه</button>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!paye_id" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>نام و نام خانوادگی</th>
                    <th>نام کاربری</th>
                    <th>کلمه عبور</th>
                    <th>شعبه</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="admine in all_lesson">
                        <td>@{{admine.id}}</td>
                        <td>@{{admine.name}}</td>
                        <td>@{{admine.username}}</td>
                        <td>@{{admine.pass}}</td>
                        <td>@{{admine.b_name}}</td>
                        <td class="td_delete" @click="delete_admin(admine.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
            <div v-if="paye_id">
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">پایه</label>
                        <input type="text" class="form-control" v-model="paye_name">
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">مقطع</label>
                        <select class="form-control" v-model="branch_type">
                            <option value="0">متوسطه اول</option>
                            <option value="1">متوسطه دوم</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top: 42px;" class="col-md-4 right list_button_insert">
                    <button type="button" class="btn btn-warning" @click="add_paye()">ویرایش پایه</button>
                    <button type="button" class="btn btn_borhan" @click="()=>{paye_id=''}">انصراف</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection