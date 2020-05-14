@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" @click="()=>{teacher_id='',goto_class=''}">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ایجاد معلم</a>
        </li>
        <li class="nav-item" @click="get_teacher(1)">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش معلم</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
            <!-- ایجاد معلم -->
            <div v-if="!goto_class">
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">نام معلم</label>
                        <input type="text" class="form-control" v-model="teacher_name">
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable"> نام کاربری (کدملی)</label>
                        <input type="text" class="form-control" v-model="teacher_user">
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">کلمه عبرور (کدملی)</label>
                        <input type="text" class="form-control" v-model="teacher_pass">
                    </div>
                </div>
                <div class="col-md-4 right list_button_insert">
                    <button type="button" class="btn btn_borhan" @click="add_teacher()">ایجاد معلم</button>
                </div>
            </div>
            <!-- انتخاب کلاس های معلم -->
            <div v-if="goto_class">
                <h4>اختصاص کلاس به استاد @{{teacher_name}}</h4>
                <div class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">شعبه</label>
                        <select class="form-control" v-model="branch_id">
                            <option v-for="branch in all_branch" :value="branch.id">@{{branch.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">پایه</label>
                        <select class="form-control" v-model="paye_id" @change="change_paye(1)">
                            <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">وضعیت درس</label>
                        <select class="form-control" v-model="branch_type" @change="()=>{get_lesson(1);}">
                            <option value="0">عمومی</option>
                            <option value="1">تخصصی</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && branch_type==1" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">رشته</label>
                        <select class="form-control" v-model="reshte_id" @change="get_lesson()">
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
                <button style="margin-top: 42px;" type="button" class="btn btn-success" @click="give_class_toteacher()">اختصصاص درس به معلم</button>
                <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{goto_class='',teacher_id=''}">اتمام</button>
                <!-- جدول نماش کلاس ها معلم -->
                <table v-if="teacher_class.length" class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <th>ردیف</th>
                        <th>شعبه</th>
                        <th>پایه</th>
                        <th>رشته</th>
                        <th>درس</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        <tr v-for="classes in teacher_class">
                            <td>@{{classes.id}}</td>
                            <td>@{{classes.b_name}}</td>
                            <td>@{{classes.p_name}}</td>
                            <td v-if="classes.r_name">@{{classes.r_name}}</td>
                            <td v-if="!classes.r_name">عمومی</td>
                            <td>@{{classes.l_name}}</td>
                            <td class="td_delete" @click="delete_teacher_class(classes.id)"><i class="fa fa-trash"></i></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!teacher_id" class="table table-striped table-bordered table-hover table-condensed">
                <div v-if="!teacher_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable"></label>
                        <input class="form-control" v-model="search_item" placeholder="نام معلم را وارد کنید">
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
                    <tr v-for="teacher in all_teacher" v-if="!search_item">
                        <td>@{{teacher.id}}</td>
                        <td>@{{teacher.name}}</td>
                        <td>@{{teacher.username}}</td>
                        <td>@{{teacher.pass}}</td>
                        <td class="td_edit" @click="teacher_edit(teacher)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_teacher(teacher.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                    <tr v-for="teacher in all_teacher" v-if="search_item && teacher.name.includes(search_item)">
                        <td>@{{teacher.id}}</td>
                        <td>@{{teacher.name}}</td>
                        <td>@{{teacher.username}}</td>
                        <td>@{{teacher.pass}}</td>
                        <td class="td_edit" @click="teacher_edit(teacher)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_teacher(teacher.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>
            </table>
            <div v-if="teacher_id">
                <div v-if="!goto_class">
                    <div class="col-md-4 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">نام معلم</label>
                            <input type="text" class="form-control" v-model="teacher_name">
                        </div>
                    </div>
                    <div class="col-md-4 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable"> نام کاربری (کدملی)</label>
                            <input type="text" class="form-control" v-model="teacher_user">
                        </div>
                    </div>
                    <div class="col-md-4 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">کلمه عبرور (کدملی)</label>
                            <input type="text" class="form-control" v-model="teacher_pass">
                        </div>
                    </div>
                    <div style="margin-top: 42px;" class="col-md-4 right list_button_insert">
                        <button type="button" class="btn btn-success" @click="add_teacher()">ویرایش و مدیریت معلم</button>
                        <button type="button" class="btn btn_borhan" @click="()=>{teacher_id=''}">انصراف</button>
                    </div>
                </div>

                <div v-if="goto_class">
                    <h4>مدیریت کلاس های استاد @{{teacher_name}}</h4>
                    <div class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">شعبه</label>
                            <select class="form-control" v-model="branch_id">
                                <option v-for="branch in all_branch" :value="branch.id">@{{branch.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">پایه</label>
                            <select class="form-control" v-model="paye_id" @change="change_paye(1)">
                                <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="with_reshte" class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">وضعیت درس</label>
                            <select class="form-control" v-model="branch_type" @change="()=>{get_lesson(1);}">
                                <option value="0">عمومی</option>
                                <option value="1">تخصصی</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="with_reshte && branch_type==1" class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">رشته</label>
                            <select class="form-control" v-model="reshte_id" @change="get_lesson()">
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
                    <button style="margin-top: 42px;" type="button" class="btn btn-success" @click="give_class_toteacher()">اختصصاص درس به معلم</button>
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{goto_class='',teacher_id=''}">برگشت</button>
                    <!-- جدول نماش کلاس ها معلم -->
                    <table v-if="teacher_class.length" class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <th>ردیف</th>
                            <th>شعبه</th>
                            <th>پایه</th>
                            <th>رشته</th>
                            <th>درس</th>
                            <th>حذف</th>
                        </thead>
                        <tbody>
                            <tr v-for="classes in teacher_class">
                                <td>@{{classes.id}}</td>
                                <td>@{{classes.b_name}}</td>
                                <td>@{{classes.p_name}}</td>
                                <td v-if="classes.r_name">@{{classes.r_name}}</td>
                                <td v-if="!classes.r_name">عمومی</td>
                                <td>@{{classes.l_name}}</td>
                                <td class="td_delete" @click="delete_teacher_class(classes.id)"><i class="fa fa-trash"></i></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection