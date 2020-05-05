<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>برهان</title>
    <link href="http://www.fontonline.ir/css/IranNastaliq.css" rel="stylesheet" type="text/css">
    <!-- =============== css ================ -->
    <!-- font-awesome -->
    <link rel="stylesheet" type="text/css" href="/as/fonts/fontAwsome/css/all.css">
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="/as/css/bootstrap/css/bootstrap.min.css">
    <!-- amazingslider -->
    <link rel="stylesheet" type="text/css" href="/as/sliderengine/amazingslider-1.css">
    <!-- my styles -->
    <link rel="stylesheet" href="/as/css/style.css">
</head>

<body>
    <div class="main" id="app" v-cloak>
        @if(Request::path()!='/')
        <div class="header">
            <nav style="background: #ea4335!important;" class="navbar navbar-expand-lg navbar-light bg-light ">
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <!-- <a class="navbar-brand" href="#">به پرتال آموزش مجازی برهان خوش آمدید</a> -->
                <!-- <div style="text-align: center" class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li style="cursor: pointer;" v-if="logined" class="nav-item active">
                            <a class="nav-link" @click="exit_user()">خروج</a>
                        </li>
                    </ul>
                </div> -->
            </nav>
        </div>
        @else
        <h1 class="org_title">
            آموزش مجازی برهان
        </h1>
        <h3 class="deskription">به پرتال آموزش مجازی برهان خوش آمدید</h3>
        @endif