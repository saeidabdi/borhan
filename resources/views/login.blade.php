<!DOCTYPE html>
<html lang="en">

<head>
    <title>آموزش آنلاین آموزشگاه برهان</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/login/style.css" rel="stylesheet" type="text/css" />
    <link href="/css/fontawesome-all.css" rel="stylesheet" />
</head>

<body>
    <h1>ورود به پرتال آموزشی</h1>
    <div class=" w3l-login-form" id="app">
        <h2>وارد شوید</h2>
            <div class=" w3l-form-group">
                <label>نام کاربری:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" v-model="username" placeholder="نام کاربری" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>کلمه عبور:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" class="form-control" v-model="pass" placeholder="*****" />
                </div>
            </div>
            <button @click="login()">ورود</button>
    </div>
    <footer>
        <p class="copyright-agileinfo"> &copy; تمامی حقوق مربوط به <a href="http://borhankonkour.com">سایت برهان</a> میباشد</p>
    </footer>
    <script src="/js/app.js"></script>
</body>

</html>