@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul v-if="!reshte_id" dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ایجاد رشته</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش رشته ها</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">رشته</label>
                    <input type="text" class="form-control" v-model="reshte_name">
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button style="margin-top: 42px;" type="button" class="btn btn_borhan" @click="add_reshte()">ایجاد رشته</button>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!reshte_id" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>رشته</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="reshte in all_reshte">
                        <td>@{{reshte.id}}</td>
                        <td>@{{reshte.title}}</td>
                        <td class="td_edit" @click="reshte_edit(reshte)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_reshte(reshte.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
            <div v-if="reshte_id">
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">رشته</label>
                        <input type="text" class="form-control" v-model="reshte_name">
                    </div>
                </div>
                <div style="margin-top: 42px;" class="col-md-4 right list_button_insert">
                    <button type="button" class="btn btn-warning" @click="add_reshte()">ویرایش پایه</button>
                    <button type="button" class="btn btn_borhan" @click="()=>{reshte_id=''}">انصراف</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection