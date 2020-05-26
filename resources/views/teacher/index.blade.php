@extends('teacher.teacher')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" @click="()=>{film_id='',goto_class=''}">ایجاد فیلم</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش فیلم</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
            <div v-if="!goto_class">
                <div class="col-md-4" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">نام فیلم</label>
                        <input type="text" class="form-control" v-model="film_name">
                    </div>
                </div>
                <div class="col-md-4" style="padding-top: 10px;">
                    <example-component @addrfilm="funcaddrfilm"></example-component>
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
                <div class="col-md-4 right list_button_insert">
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="add_film()">ایجاد فیلم</button>
                </div>
            </div>
            <div v-if="goto_class">
                <table v-if="all_special_film.length" class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <th>ردیف</th>
                        <th>شعبه</th>
                        <th>پایه</th>
                        <th>رشته</th>
                        <th>درس</th>
                        <th>ساعت</th>
                        <th>اجازه پخش</th>
                    </thead>
                    <tbody>
                        <tr v-for="special in all_special_film">
                            <td>@{{special.id}}</td>
                            <td>@{{special.b_name}}</td>
                            <td>@{{special.p_name}}</td>
                            <td v-if="special.r_name">@{{special.r_name}}</td>
                            <td v-if="!special.r_name">عمومی</td>
                            <td>@{{special.l_name}}</td>
                            <td>
                                <input v-model="limit_times[special.id]" type="number" placeholder="زمان مهلت تماشا">
                            </td>
                            <!-- if for incule icons -->
                            <td v-if="!specail_ids.includes(special.id)" class="td_delete" @click="allow_show(special.b_id,special.id)"><i class="fa fa-eye-slash" aria-hidden="true"></i></td>
                            <td v-if="specail_ids.includes(special.id)" class="td_delete"><i class="fa fa-eye" aria-hidden="true"></i></td>
                        </tr>
                    </tbody>

                </table>
                <div v-if="!all_special_film.length">
                    هیچ کلاسی به این معلم تعلق نگرفته
                </div>
                <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{goto_class='',film_id=''}">اتمام</button>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!film_id" class="table table-striped table-bordered table-hover table-condensed">
                <div v-if="!film_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">پایه</label>
                        <select class="form-control" v-model="paye_id" @change="change_paye(2)">
                            <option v-for="paye in all_paye" :value="paye.id">@{{paye.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && !film_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">وضعیت درس</label>
                        <select class="form-control" v-model="branch_type" @change="()=>{get_reshte_teacher();}">
                            <option value="0">عمومی</option>
                            <option value="1">تخصصی</option>
                        </select>
                    </div>
                </div>
                <div v-if="with_reshte && branch_type==1 && !film_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">رشته</label>
                        <select class="form-control" v-model="reshte_id" @change="get_lesson_teacher()">
                            <option v-for="reshte in all_reshte" :value="reshte.id">@{{reshte.title}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="!film_id" class="col-md-3 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">درس</label>
                        <select class="form-control" v-model="lesson_id">
                            <option v-for="lesson in all_lesson" :value="lesson.id">@{{lesson.name}}</option>
                        </select>
                    </div>
                </div>
                <div v-if="!film_id" class="col-md-4 right list_button_insert">
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="get_film()">نمایش فیلم ها</button>
                </div>
                <thead>
                    <th>ردیف</th>
                    <th>عنوان</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="film in all_film">
                        <td>@{{film.id}}</td>
                        <td>@{{film.title}}</td>
                        <td class="td_edit" @click="film_edit(film)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_film(film.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>
            </table>
            <div v-if="film_id">
                <div v-if="!goto_class">
                    <div class="col-md-4" style="padding-top: 10px;">
                        <div class="form-group">
                            <label class="label cat_lable">نام فیلم</label>
                            <input type="text" class="form-control" v-model="film_name">
                        </div>
                    </div>
                    <div class="col-md-4" style="padding-top: 10px;">
                        <video width="320" height="240" controls>
                            <source :src="'/images/'+film_addr" type="video/mp4">
                        </video>
                    </div>
                    <div style="margin-top: 42px;" class="col-md-4 right list_button_insert">
                        <button type="button" class="btn btn-warning" @click="edit_filmfunc()">ویرایش و مدیریت فیلم</button>
                        <button type="button" class="btn btn_borhan" @click="()=>{film_id=''}">انصراف</button>
                    </div>
                </div>

                <div v-if="goto_class">
                    <table v-if="all_special_film.length" class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <th>ردیف</th>
                            <th>شعبه</th>
                            <th>پایه</th>
                            <th>رشته</th>
                            <th>درس</th>
                            <th>ساعت</th>
                            <th>اجازه پخش</th>
                        </thead>
                        <tbody>
                            <tr v-for="special in all_special_film">
                                <td>@{{special.id}}</td>
                                <td>@{{special.b_name}}</td>
                                <td>@{{special.p_name}}</td>
                                <td v-if="special.r_name">@{{special.r_name}}</td>
                                <td v-if="!special.r_name">عمومی</td>
                                <td>@{{special.l_name}}</td>
                                <td>
                                    <input v-model="limit_times[special.id]" type="number" placeholder="زمان مهلت تماشا">
                                </td>
                                <!-- if for incule icons -->
                                <td v-if="!specail_ids.includes(special.id)" class="td_delete" @click="allow_show(special.b_id,special.id)"><i class="fa fa-eye-slash" aria-hidden="true"></i></td>
                                <td v-if="specail_ids.includes(special.id)" class="td_delete"><i class="fa fa-eye" aria-hidden="true"></i></td>
                            </tr>
                        </tbody>

                    </table>
                    <div v-if="!all_special_film.length">
                        هیچ کلاسی به این معلم تعلق نگرفته
                    </div>
                    <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="()=>{goto_class='',film_id=''}">اتمام</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection