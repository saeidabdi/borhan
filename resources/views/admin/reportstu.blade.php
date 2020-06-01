@extends('admin.admin')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <table v-if="!stu_id" class="table table-striped table-bordered table-hover table-condensed">
        <div v-if="!stu_id" class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">پایه</label>
                <select class="form-control" v-model="paye_id" @change="change_paye(1)">
                    <option value="0">انتخاب</option>
                    <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                </select>
            </div>
        </div>
        <div v-if="with_reshte && !stu_id" class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">وضعیت درس</label>
                <select class="form-control" v-model="branch_type" @change="()=>{get_lesson(1);}">
                    <option value="0">عمومی</option>
                    <option value="1">تخصصی</option>
                </select>
            </div>
        </div>
        <div v-if="with_reshte && branch_type==1 && !stu_id" class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">رشته</label>
                <select class="form-control" v-model="reshte_id" @change="get_lesson()">
                    <option value="0">انتخاب</option>
                    <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                </select>
            </div>
        </div>
        <div v-if="!stu_id" class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">درس</label>
                <select class="form-control" v-model="lesson_id">
                    <option value="0">انتخاب</option>
                    <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                </select>
            </div>
        </div>
        <div v-if="!stu_id" class="col-md-3 right list_button_insert">
            <button style="margin-top: 42px;display:inline-block;" type="button" class="btn btn_borhan" @click="report_stu()">گزارش </button>
            <export-excel :data="all_stu" style="display: inline-block;" :fields="json_fields" name="students_file">
                <button style="margin-top: 42px;display:inline-block;" type="button" class="btn btn-success">
                    <i class="fas fa-file-excel"></i>
                    اکسل </button>
            </export-excel>
        </div>
        <thead>
            <th>ردیف</th>
            <th>دانش آموز</th>
            <th>نام کاربری</th>
            <th>جنسیت</th>
            <th>تاریخ تولد</th>
            <th>آخرین معدل</th>
            <th>جزئیات</th>
        </thead>
        <tbody>
            <tr v-for="(stu, index) in all_stu">
                <td>@{{index+1}}</td>
                <td>@{{stu.name}}</td>
                <td>@{{stu.username}}</td>
                <td v-if="stu.gender==0">آقا</td>
                <td v-if="stu.gender==1">خانم</td>
                <td>@{{stu.birthday}}</td>
                <td>@{{stu.last_avg}}</td>
                <td class="td_delete" @click="detale_stu(stu.id)" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i></td>
            </tr>
        </tbody>
    </table>
    <div v-if="stu_id" class="content_detale">
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">دانش آموز :</label>
                <span class=" span_datale">@{{detale.name}}</span>
            </div>
        </div>
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">مدرسه : </label>
                <span class="span span_datale">@{{detale.school}}</span>
            </div>
        </div>
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شغل پدر : </label>
                <span class="span span_datale">@{{detale.job_father}}</span>
            </div>
        </div>
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">تاریخ تولد : </label>
                <span class="span span_datale">@{{detale.birthday}}</span>
            </div>
        </div>
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">جنسیت : </label>
                <span v-if="detale.gender == 0" class="span span_datale">پسر</span>
                <span v-if="detale.gender == 1" class="span span_datale">دختر</span>
            </div>
        </div>
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable"> نام کاربری (کدملی) : </label>
                <span class="span span_datale">@{{detale.username}}</span>
            </div>
        </div>
        <div class="col-md-12 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">آدرس منزل : </label>
                <span class="span span_datale">@{{detale.addr}}</span>
            </div>
        </div>
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">آخرین معدل : </label>
                <span class="span span_datale">@{{detale.last_avg}}</span>
            </div>
        </div>
        <div class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">پایه : </label>
                <span class="span span_datale">@{{detale.p_title}}</span>
            </div>
        </div>
        <div v-if="detale.r_title" class="col-md-4 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">رشته : </label>
                <span class="span span_datale">@{{detale.r_title}}</span>
            </div>
        </div>
        <hr class="right">
        <h4 class="col-md-12 right" style="color:#555">شماره های تماس : </h4>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره منزل : </label>
                <span class="span span_datale">@{{detale.phone_home}}</span>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره پدر : </label>
                <span class="span span_datale">@{{detale.phone_father}}</span>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره مادر : </label>
                <span class="span span_datale">@{{detale.phone_mother}}</span>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <div class="form-group">
                <label class="label cat_lable">شماره دانش آموز : </label>
                <span class="span span_datale">@{{detale.phone_stu}}</span>
            </div>
        </div>
        <div class="col-md-3 right" style="padding-top: 10px;">
            <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{stu_id=''}">برگشت</button>
            <!-- <button style="margin-top: 42px;" type="button" class="btn btn-success" @click="pdfdwonload">
                <i class="fas fa-file-pdf"></i>
                pdf
            </button> -->
        </div>
    </div>


</div>

@endsection