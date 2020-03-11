<!DOCTYPE html>
<html lang="en">

<head>
    <title>مدیریت</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/fontawesome-all.css" rel="stylesheet" />
    <link href="/css/app.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="main" id="app" v-cloak v-if="logined">
        <div class="header">
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">برهان</a>
                <div style="text-align: center" class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin">صفحه ی اصلی پنل</a>
                        </li>
                        <li style="cursor: pointer;" v-if="logined" class="nav-item active">
                            <a class="nav-link" @click="exit_user()">خروج</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>