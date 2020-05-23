@extends('user.user')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" style="background: #f5f5f5;" class="p-4 p-md-5 pt-5 col-md-12">
    <div class="col-md-12 right">
        <div style="text-align: center;padding-bottom: 12px;border-radius: 70px 70px 0 0;" class="branch_item">
            <h2 style="color:#555;font-size:22px;line-height: 40px;margin-bottom: 0!important;" class="mb-4">مدیر گرامی @{{name}} خوش آمدید</h2>
        </div>
    </div>
    <div class="col-md-3 right">
        <div style="text-align: center;" class="branch_item">
            <img style="width: 83%;" src="/as/images/school2.png" alt="">
            <h3 class="h3_branch">شعبات</h3>
            <span class="badge badge-danger">@{{branch_count}}</span>
        </div>
    </div>
    <div class="col-md-3 right">
        <div style="text-align: center;" class="branch_item">
            <img style="width: 83%;" src="/as/images/cinema.png" alt="">
            <h3 class="h3_branch">فیلم</h3>
            <span class="badge badge-danger">@{{film_count}}</span>
        </div>
    </div>
    <div class="col-md-3 right">
        <div style="text-align: center;" class="branch_item">
            <img style="width: 83%;" src="/as/images/teacher.png" alt="">
            <h3 class="h3_branch">معلم</h3>
            <span class="badge badge-danger">@{{teacher_count}}</span>
        </div>
    </div>
    <div class="col-md-3 right">
        <div style="text-align: center;" class="branch_item">
            <img style="width: 83%;" src="/as/images/student.png" alt="">
            <h3 class="h3_branch">دانش آموز</h3>
            <span class="badge badge-danger">@{{stu_count}}</span>
        </div>
    </div>
    <div class="col-md-12 right">
        <div style="text-align: center;padding-bottom: 12px;border-radius: 70px 70px 0 0;margin-top:25px;" class="branch_item">
            <h2 style="color:#555;font-size:20px;line-height: 40px;margin-bottom: 0!important;" class="mb-4">فعال ترین ها طی هفته گذشته</h2>
        </div>
    </div>
    <div class="col-md-6 right">
        <div style="text-align: center;" class="branch_item">
            <h3 class="h3_branch">فعال ترین دانش آموز</h3>
            <p>نام و نام خانوادگی : @{{stu_name}}</p>
        </div>
    </div>
    <div class="col-md-6 right">
        <div style="text-align: center;" class="branch_item">
            <h3 class="h3_branch">فعال ترین معلم</h3>
            <p>نام و نام خانوادگی : @{{teacher_name}}</p>
        </div>
    </div>
</div>
@endsection