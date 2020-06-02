<!doctype html>
<html lang="en">

<head>
    <title>پنل مدیریت</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/as/fonts/fontAwsome/css/all.css">
    <link rel="stylesheet" type="text/css" href="/as/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/user/css/style.css">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch" id="app" v-if="logined" v-cloak>
        <nav id="sidebar" class="order-last" class="img" style="background-image: url(/user/images/bg_1.jpg);" v-cloak>
            <div class="custom-menu">
                <button type="button" @click="btn_menu()" id="sidebarCollapse" class="btn btn-bars">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="">
                <h1>
                    <a class="logo">
                        @{{name}}
                        <span>مدیر</span>
                    </a>
                </h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="/admin/index">
                            <span style="margin-left: 5px" class="fas fa-graduation-cap mr-3"></span>
                            مدیریت دانش آموزان
                        </a>
                    </li>
                    <li class="active">
                        <a href="/admin/film">
                            <span style="margin-left: 5px" class="fas fa-film mr-3"></span>
                            مدیریت فیلم
                        </a>
                    </li>
                    <li class="active">
                        <a href="/admin/reportstu">
                            <span style="margin-left: 5px" class="fas fa-file-excel mr-3"></span>
                            دانش آموز
                        </a>
                    </li>
                    <li class="active">
                        <a href="/admin/report">
                            <span style="margin-left: 5px" class="fas  fa-check-square mr-3"></span>
                            حضور و غیاب
                        </a>
                    </li>
                    <li class="active">
                        <a class="dropdown-item" href="/admin/exam">
                            <span style="margin-left: 5px" class="fas fa-table mr-3"></span>
                            امتحانات
                        </a>
                    </li>
                    <li class="active">
                        <a href="/admin/pass">
                            <span style="margin-left: 5px" class="fas fa-key mr-3"></span>
                            تغیر کلمه عبور
                        </a>
                    </li>
                    <li class="active">
                        <a @click="exit_user()">
                            <span style="margin-left: 5px" class="fas fa-sign-out-alt mr-3"></span>
                            خروج
                        </a>
                    </li>
                </ul>
            </div>

        </nav>