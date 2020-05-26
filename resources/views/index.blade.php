@include('header')
<div class="content">
    <div class="col-lg-12 col-md-12 col-sx-12">
        <div style="margin: 0 auto" dir="ltr" class="col-md-9 col-xs-12 col-sm-12 "><!-- for_slider -->
            <div id="base">
                <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:789px;margin:0px auto 56px;">
                    <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                        <ul class="amazingslider-slides" style="display:none;">
                            <li><img src="/as/images/erfan4.png" alt="" title="" />
                            </li>
                            <li><img src="/as/images/erfan2.png" alt="" title="" />
                            </li>
                            <li><img src="/as/images/erfan3.png" alt="" title="" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="login_form">
                <!-- =============== inputs and buttons ================ -->
                <div class="col-lg-10 col-md-10 col-sx-10" style="float: right;">
                    <div style="margin-top: 65px;" class="input-group mb-2 login_inputs">
                        <input dir="rtl" type="text" v-model="username" class="form-control" placeholder="نام کاربری">
                        <i v-if="!username" class="fa fa-user"></i>
                        <i v-if="username" class="fa fa-user active"></i>
                    </div>
                    <div class="input-group mb-2 login_inputs">
                        <input type="password" dir="rtl" v-model="pass" class="form-control" placeholder="*****">
                        <i v-if="!pass" class="fa fa-lock"></i>
                        <i v-if="pass" class="fa fa-lock active"></i>
                    </div>
                    <!-- login -->
                    <button class="btn_login btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0 col-md-4" type="submit" @click="stu_login()">
                        دانش آموز
                        <i class="fas fa-graduation-cap"></i>
                    </button>
                    <button class="btn_login btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0 col-md-3" type="submit" @click="teach_login()">
                        معلم
                        <i class="fas fa-chalkboard-teacher"></i>
                    </button>
                    <button  class="btn_login btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0 col-md-4" type="submit" @click="admin_login()">
                        مدیر
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4 siderbar">
            <div class="list-group" style="margin-top: 55px;">
                <a class="list-group-item list-group-item-action">
                    <div class="thumb_date right">
                        نکته اول
                    </div>
                    <div style="margin-top: 20px;font-size: 15px;">
                        شما تنها در زمان مشخص برای هر فیلم مجاز به دیدن آن فیلم میباشید
                    </div>

                </a>
                <a class="list-group-item list-group-item-action">
                    <div class="thumb_date right">
                        نکته دوم
                    </div>
                    <div style="margin-top: 20px;font-size: 15px;">
                        زمان ورود و خروج شما از فیلم ثبت و در اختیار استاد و آموزشگاه قرار میگیرد
                    </div>
                </a>
                <a class="list-group-item list-group-item-action">
                    <div class="thumb_date right">
                        نکته سوم
                    </div>
                    <div style="margin-top: 20px;font-size: 15px;">
                        شما تنها یکبار مجاز به دیدن هر فیلم میباشید
                    </div>
                </a>
            </div>
        </div> -->
    </div>
</div>
<loading :active.sync="isLoading" 
         color="#fff"
         background-color="#000"
         loader="dots"></loading>
@include('footer')