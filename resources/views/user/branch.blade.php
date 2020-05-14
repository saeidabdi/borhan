@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5">
    <ul dir="rtl" class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ایجاد شعبه</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">نمایش شعبه</a>
        </li>
    </ul>
    <div dir="rtl" class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">نام شعبه(مدرسه و کنکور)</label>
                    <input type="text" class="form-control" v-model="branch_name">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">آدرس</label>
                    <input type="text" class="form-control" v-model="branch_addr">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">نوع</label>
                    <select class="form-control" v-model="branch_type">
                        <option value="0">مدرسه</option>
                        <option value="1">آموزشگاه کنکور</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button type="button" class="btn btn_borhan" @click="add_branch()">ایجاد شعبه</button>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table v-if="!branch_id" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>آدرس</th>
                    <th>نوع</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="branch in all_branch">
                        <td>@{{branch.id}}</td>
                        <td>@{{branch.name}}</td>
                        <td>@{{branch.addr}}</td>
                        <td v-if="branch.type==0">مدرسه</td>
                        <td v-if="branch.type==1">آموزشگاه</td>
                        <td class="td_edit" @click="branch_edit(branch)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_branch(branch.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
            <div v-if="branch_id">
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">نام شعبه(مدرسه و کنکور)</label>
                        <input type="text" class="form-control" v-model="branch_name">
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">آدرس</label>
                        <input type="text" class="form-control" v-model="branch_addr">
                    </div>
                </div>
                <div class="col-md-4 right" style="padding-top: 10px;">
                    <div class="form-group">
                        <label class="label cat_lable">نوع</label>
                        <select class="form-control" v-model="branch_type">
                            <option value="0">مدرسه</option>
                            <option value="1">آموزشگاه کنکور</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 right list_button_insert">
                    <button type="button" class="btn btn-warning" @click="add_branch()">ویرایش شعبه</button>
                    <button type="button" class="btn btn_borhan" @click="()=>{branch_id=''}">انصراف</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection