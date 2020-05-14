@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul v-if="!lesson_id" dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ایجاد درس</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش دروس</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">

            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">درس</label>
                    <input type="text" class="form-control" v-model="lesson_name">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">پایه</label>
                    <select class="form-control" v-model="paye_id" @change="change_paye()">
                        <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                    </select>
                </div>
            </div>
            <div v-if="with_reshte" class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">وضعیت درس</label>
                    <select class="form-control" v-model="branch_type">
                        <option value="0">عمومی</option>
                        <option value="1">تخصصی</option>
                    </select>
                </div>
            </div>
            <div v-if="with_reshte && branch_type==1" class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">رشته</label>
                    <select class="form-control" v-model="reshte_id">
                        <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="add_lesson()">ایجاد درس</button>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!lesson_id" class="table table-striped table-bordered table-hover table-condensed">
                <div v-if="!lesson_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">پایه</label>
                        <select class="form-control" v-model="paye_id" @change="change_paye()">
                            <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && !lesson_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">وضعیت درس</label>
                        <select class="form-control" v-model="branch_type">
                            <option value="0">عمومی</option>
                            <option value="1">تخصصی</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && branch_type==1 && !lesson_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">رشته</label>
                        <select class="form-control" v-model="reshte_id">
                            <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="!lesson_id" class="col-md-3 right list_button_insert">
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="get_lesson()">نمایش دروس</button>
                </div>
                <thead>
                    <th>ردیف</th>
                    <th>درس</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="lesson in all_lesson">
                        <td>@{{lesson.id}}</td>
                        <td>@{{lesson.name}}</td>
                        <td class="td_edit" @click="lesson_edit(lesson)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_lesson(lesson.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
            <div v-if="lesson_id">
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">درس</label>
                        <input type="text" class="form-control" v-model="lesson_name">
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">پایه</label>
                        <select class="form-control" v-model="paye_id" @change="change_paye()">
                            <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte" class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">وضعیت درس</label>
                        <select class="form-control" v-model="branch_type">
                            <option value="0">عمومی</option>
                            <option value="1">تخصصی</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && branch_type==1" class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">رشته</label>
                        <select class="form-control" v-model="reshte_id">
                            <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top: 42px;" class="col-md-4 right list_button_insert">
                    <button type="button" class="btn btn-warning" @click="add_lesson()">ویرایش درس</button>
                    <button type="button" class="btn btn_borhan" @click="()=>{lesson_id=''}">انصراف</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection