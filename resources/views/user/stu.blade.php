@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" @click="()=>{stu_id='',goto_class=''}">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ثبت نام</a>
        </li>
        <li class="nav-item" @click="get_stu(1)">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش دانش آموزان</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
            <!-- ایجاد معلم -->
            <div v-if="!goto_class">
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">نام دانش آموز</label>
                        <input type="text" class="form-control" v-model="stu_name">
                    </div>
                </div>
                <div class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">پایه</label>
                        <select class="form-control" v-model="paye_id" @change="change_paye()">
                            <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">رشته</label>
                        <select class="form-control" v-model="reshte_id">
                            <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable"> نام کاربری (کدملی)</label>
                        <input type="text" class="form-control" v-model="stu_user">
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">کلمه عبرور (کدملی)</label>
                        <input type="text" class="form-control" v-model="stu_pass">
                    </div>
                </div>
                <div class="col-md-4 right list_button_insert">
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="add_stu()">ایجاد دانش آموز</button>
                </div>
            </div>
            <!-- انتخاب کلاس های معلم -->
            <div v-if="goto_class">
                <h4>برنامه ی کلاسی @{{stu_name}}</h4>
                <div class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">شعبه</label>
                        <select class="form-control" v-model="branch_id" @change="change_branch()">
                            <option v-for="branch in all_branch" :value="branch.id">@{{branch.name}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">درس</label>
                        <select class="form-control" v-model="lesson_id">
                            <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                        </select>
                    </div>
                </div>
                <button v-if="with_reshte" style="margin-top: 42px;" type="button" class="btn btn-success" @click="give_class_tostu()">اختصصاص درس به دانش آموز</button>
                <button v-if="!with_reshte" style="margin-top: 42px;" type="button" class="btn btn-success" @click="give_class_tostu()">اختصاص همه ی دروس</button>
                <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{goto_class='',stu_id=''}">اتمام</button>
                <!-- جدول نماش کلاس ها معلم -->
                <table v-if="stu_class.length" class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <th>ردیف</th>
                        <th>شعبه</th>
                        <th>درس</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        <tr v-for="classes in stu_class">
                            <td>@{{classes.id}}</td>
                            <td>@{{classes.b_name}}</td>
                            <td v-if="classes.l_name">@{{classes.l_name}}</td>
                            <td v-if="!classes.l_name">همه دروس</td>
                            <td class="td_delete" @click="stu_teacher_class(classes.id)"><i class="fa fa-trash"></i></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!stu_id" class="table table-striped table-bordered table-hover table-condensed">
                <div v-if="!stu_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable"></label>
                        <input class="form-control" v-model="search_item" placeholder="نام دانش آموز را وارد کنید">
                    </div>
                </div>
                <thead>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>نام کاربری</th>
                    <th>کلمه عبور</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="stu in all_stu" v-if="!search_item">
                        <td>@{{stu.id}}</td>
                        <td>@{{stu.name}}</td>
                        <td>@{{stu.username}}</td>
                        <td>@{{stu.pass}}</td>
                        <td class="td_edit" @click="stu_edit(stu)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_stu(stu.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                    <tr v-for="stu in all_stu" v-if="search_item && stu.name.includes(search_item)">
                        <td>@{{stu.id}}</td>
                        <td>@{{stu.name}}</td>
                        <td>@{{stu.username}}</td>
                        <td>@{{stu.pass}}</td>
                        <td class="td_edit" @click="stu_edit(stu)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_stu(stu.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>
            </table>
            <div v-if="stu_id">
                <div v-if="!goto_class">
                    <div class="col-md-4 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">نام دانش آموز</label>
                            <input type="text" class="form-control" v-model="stu_name">
                        </div>
                    </div>
                    <div class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">پایه</label>
                            <select class="form-control" v-model="paye_id" @change="change_paye()">
                                <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="with_reshte" class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">رشته</label>
                            <select class="form-control" v-model="reshte_id">
                                <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable"> نام کاربری (کدملی)</label>
                            <input type="text" class="form-control" v-model="stu_user">
                        </div>
                    </div>
                    <div class="col-md-4 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">کلمه عبرور (کدملی)</label>
                            <input type="text" class="form-control" v-model="stu_pass">
                        </div>
                    </div>
                    <div class="col-md-4 right list_button_insert">
                        <button style="margin-top: 42px;" type="button" class="btn btn-success" @click="add_stu()">ویرایش و مدیریت دانش آموز</button>
                        <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{stu_id=''}">انصراف</button>
                    </div>
                </div>

                <div v-if="goto_class">
                    <h4>برنامه ی کلاسی @{{stu_name}}</h4>
                    <div class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">شعبه</label>
                            <select class="form-control" v-model="branch_id" @change="change_branch()">
                                <option v-for="branch in all_branch" :value="branch.id">@{{branch.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="with_reshte" class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">درس</label>
                            <select class="form-control" v-model="lesson_id">
                                <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                            </select>
                        </div>
                    </div>
                    <button v-if="with_reshte" style="margin-top: 42px;" type="button" class="btn btn-success" @click="give_class_tostu()">اختصصاص درس به دانش آموز</button>
                    <button v-if="!with_reshte" style="margin-top: 42px;" type="button" class="btn btn-success" @click="give_class_tostu()">اختصاص همه ی دروس</button>
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{goto_class='',stu_id=''}">اتمام</button>
                    <!-- جدول نماش کلاس ها معلم -->
                    <table v-if="stu_class.length" class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <th>ردیف</th>
                            <th>شعبه</th>
                            <th>درس</th>
                            <th>حذف</th>
                        </thead>
                        <tbody>
                            <tr v-for="classes in stu_class">
                                <td>@{{classes.id}}</td>
                                <td>@{{classes.b_name}}</td>
                                <td v-if="classes.l_name">@{{classes.l_name}}</td>
                                <td v-if="!classes.l_name">همه دروس</td>
                                <td class="td_delete" @click="stu_teacher_class(classes.id)"><i class="fa fa-trash"></i></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection