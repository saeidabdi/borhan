@extends('teacher.teacher')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" @click="()=>{goto_class='',edited=''}">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ایجاد آزمون</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش آزمون</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
            <!-- ایجاد معلم -->
            <div v-if="!goto_class">
                <div class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">عنوان آزمون</label>
                        <input type="text" class="form-control" v-model="film_name">
                    </div>
                </div>
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
                        <select class="form-control" v-model="lesson_id" @change="get_film()">
                            <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 right list_button_insert">
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="add_exam()">ایجاد آزمون</button>
                </div>
            </div>
            <!-- انتخاب کلاس های معلم -->
            <div v-if="goto_class">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <th>ردیف</th>
                        <th>دانش آموز</th>
                        <th>کد ملی</th>
                        <th>نمره</th>
                    </thead>
                    <tbody>
                        <tr v-for="(stu, index) in all_stu">
                            <td>@{{index + 1}}</td>
                            <td>@{{stu.name}}</td>
                            <td>@{{stu.username}}</td>
                            <td><input v-model="specail_ids[stu.id]" type="number" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
                <button v-if="all_stu.length" style="margin-top: 42px;" type="button" class="btn btn-success" @click="add_grade()">ثبت نمرات</button>
                <div v-if="!all_stu.length">
                    هیچ دانش آموزی وجود ندارد
                </div>
                <button v-if="!all_stu.length" style="margin-top: 42px;" type="button" class="btn btn-danger" @click="goto_class='' ">برگشت</button>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!exam_id" class="table table-striped table-bordered table-hover table-condensed">
                <div v-if="!exam_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">شعبه</label>
                        <select class="form-control" v-model="branch_id" @change="get_paye_teacher(teacher_id,2)">
                            <option v-for="branch in all_branch" :value="branch.id">@{{branch.name}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="!exam_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">پایه</label>
                        <select class="form-control" v-model="paye_id" @change="change_paye(2)">
                            <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && !exam_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">وضعیت درس</label>
                        <select class="form-control" v-model="branch_type" @change="()=>{get_reshte_teacher();}">
                            <option value="0">عمومی</option>
                            <option value="1">تخصصی</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && branch_type==1 && !exam_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">رشته</label>
                        <select class="form-control" v-model="reshte_id" @change="get_lesson_teacher()">
                            <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="!exam_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">درس</label>
                        <select class="form-control" v-model="lesson_id" @change="get_film()">
                            <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="!exam_id" class="col-md-4 right list_button_insert">
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="get_exam()">نمایش آزمون</button>
                </div>
                <thead>
                    <th>ردیف</th>
                    <th>عنوان آزمون</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="exam in all_exam">
                        <td>@{{exam.id}}</td>
                        <td>@{{exam.title}}</td>
                        <td class="td_edit" @click="exam_edit(exam)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_exam(exam.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>
            </table>
            <div v-if="exam_id">
                <div v-if="!goto_class">
                    <div class="col-md-3 right" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">عنوان آزمون</label>
                            <input type="text" class="form-control" v-model="film_name">
                        </div>
                    </div>
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
                            <select class="form-control" v-model="lesson_id" @change="get_film()">
                                <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 right list_button_insert">
                        <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="add_exam()">ویرایش و مدریت فیلم</button>
                        <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{exam_id=''}">برگشت</button>
                    </div>
                </div>

                <div v-if="goto_class">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <th>ردیف</th>
                            <th>دانش آموز</th>
                            <th>کد ملی</th>
                            <th>نمره</th>
                        </thead>
                        <tbody>
                            <tr v-for="(stu, index) in all_stu">
                                <td>@{{index + 1}}</td>
                                <td>@{{stu.name}}</td>
                                <td>@{{stu.username}}</td>
                                <td><input v-model="specail_ids[stu.id]" type="number" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button v-if="all_stu.length" style="margin-top: 42px;" type="button" class="btn btn-success" @click="add_grade()">ثبت نمرات</button>
                    <div v-if="!all_stu.length">
                        هیچ دانش آموزی وجود ندارد
                    </div>
                    <button style="margin-top: 42px;" type="button" class="btn btn-danger" @click="()=>{goto_class='',edited=''} ">برگشت</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection