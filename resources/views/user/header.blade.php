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
                        <span v-if="type==1">مدیر ارشد</span>
                    </a>
                </h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="/user/index"><span class="fas fa-tachometer-alt mr-3"></span> داشبورد</a>
                    </li>
                    <li class="active">
                        <a href="/user/branch">
                            <span style="margin-left: 5px" class="fas fa-university mr-3"></span>
                            شعبات
                        </a>
                    </li>
                    <li class="active">
                        <a href="/user/paye">
                            <span style="margin-left: 5px" class="fas fa-database mr-3"></span>
                            پایه
                        </a>
                    </li>
                    <li class="active">
                        <a href="/user/reshte">
                            <span style="margin-left: 5px" class="fas fa-code-branch mr-3"></span>
                            رشته
                        </a>
                    </li>
                    <li class="active">
                        <a href="/user/dars">
                            <span style="margin-left: 5px" class="fas fa-book mr-3"></span>
                            دروس
                        </a>
                    </li>
                    <li class="active">
                        <a href="/user/teacher">
                            <span style="margin-left: 5px" class="fas fa-chalkboard-teacher mr-3"></span>
                            مدیریت اساتید
                        </a>
                    </li>
                    <li class="active">
                        <a href="/user/stu">
                            <span style="margin-left: 5px" class="fas fa-graduation-cap mr-3"></span>
                            مدیریت دانش آموزان
                        </a>
                    </li>
                    <li class="active">
                        <a href="/user/film">
                            <span style="margin-left: 5px" class="fas fa-film mr-3"></span>
                            مدیریت فیلم
                        </a>
                    </li>
                    <li class="active dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <span style="margin-left: 5px" class="fas fa-chart-bar mr-3"></span>
                            گزارشات
                        </a>
                        <ul style="background: #ea4335 none repeat scroll 0% 0%;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="active">
                                <a class="dropdown-item" href="/user/report">
                                    <span style="margin-left: 5px" class="fas  fa-check-square mr-3"></span>
                                    حضور و غیاب
                                </a>
                            </li>
                        </ul>
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