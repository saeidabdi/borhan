<!doctype html>
<html lang="en">

<head>
    <title>پنل مدیریت</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/as/fonts/fontAwsome/css/all.css">
    <link rel="stylesheet" type="text/css" href="/as/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/user/css/style.css">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch" id="app" v-if="logined" v-cloak>
        <nav id="sidebar" class="order-last" class="img" style="background-image: url(/user/images/bg_1.jpg);" v-cloak>
            <div class="custom-menu">
                <!-- <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                </button> -->
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
                            <span style="margin-left: 5px" class="fas fa-code-branch mr-3"></span>
                            شعبات
                        </a>
                    </li>
                </ul>
            </div>

        </nav>