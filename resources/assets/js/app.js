
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Swal from 'sweetalert2'
import axios from 'axios';

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// loding component
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
// dropzone component
Vue.component('example-component', require('./components/ExampleComponent.vue'));
// video


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes = [
    { path: '/lesson', name: 'lesson', component: require('./components/lesson.vue') }
]
const router = new VueRouter({
    routes,
    mode: 'history'
})

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        name: '', username: '', pass: '', logined: '', isLoading: false, type: '', branch_name: '', branch_addr: '', branch_type: 0, all_branch: [], branch_id: '', paye_name: '', all_paye: [], paye_id: '', reshte_name: '', all_reshte: [], reshte_id: '', lesson_name: '', with_reshte: '', all_lesson: [], lesson_id: '',
        teacher_name: '', teacher_pass: '', teacher_user: '', goto_class: '', teacher_id: '', teacher_class: [], all_teacher: [], search_item: '', teach_id: '',
        stu_name: '', stu_user: '', stu_pass: '', stu_id: '', stu_class: [], all_stu: [],
        film_name: '', film_addr: '', all_special_film: [], specail_ids: [], limit_times: [],
        film_id: '', all_film: [], i: 1, status: 0, message: '', view_id: '', all_absent: [],
        new_pass: '', new_pass2: '',
        stu_count: '', teacher_count: '', film_count: '', branch_count: '',
    },
    mounted() {
        var a = this;
        // if (window.innerWidth > 960) {
        //     $('#sidebar').css('margin-right', '0!important')
        //     this.i = 0;
        // }else{
        //     $('#sidebar').css('margin-right', '-300px!important')
        //     this.i = 1;
        // }
        window.addEventListener('popstate', (e) => {
            a.status = a.status - 1;
        })
        if (window.location.pathname.split('/')[1] == 'user') {
            this.getuser();
        } else if (window.location.pathname.split('/')[1] == 'stu') {
            this.getstu();
        } else if (window.location.pathname.split('/')[1] == 'teacher') {
            this.getteach();
        }
    },
    components: {
        Loading
    },
    router,
    methods: {
        //******************* */ user
        // index
        get_index() {
            this.isLoading = true
            axios
                .get('/user/get_index')
                .then(response => {
                    this.stu_count = response.data.stu;
                    this.teacher_count = response.data.teacher;
                    this.film_count = response.data.film;
                    this.branch_count = response.data.branch;
                    this.teacher_name = response.data.activest_teacher.name;
                    this.stu_name = response.data.activest_student.name;
                    this.isLoading = false;
                })
        },
        // branch
        admin_login() {
            this.isLoading = true;
            axios
                .post('/user/login', {
                    username: this.username,
                    pass: this.pass

                }).then(response => {
                    this.isLoading = false;
                    if (response.data.username != undefined) {
                        Swal.fire('', 'مدیر گرامی ' + response.data.name + ' شما وارد شدید', 'success');
                        location.href = "/user/index";

                    } else {
                        Swal.fire('', 'کاربر وجود ندارد', 'warning');

                    }

                }, response => {
                    this.isLoading = false;
                    Swal.fire('', 'مشکل در اتصال به سرور', 'warning');
                });
        },
        getuser() {
            // if (window.location.pathname != '/') {
            axios.get('/user/getuser').then(response => {
                if (response.data.username != undefined) {
                    if (window.location.pathname == '/user/branch' || window.location.pathname == '/user/teacher' || window.location.pathname == '/user/stu' || window.location.pathname == '/user/film' || window.location.pathname == '/user/report') {
                        this.get_branch();
                    }
                    if (window.location.pathname == '/user/paye' || window.location.pathname == '/user/dars' || window.location.pathname == '/user/teacher' || window.location.pathname == '/user/stu' || window.location.pathname == '/user/film' || window.location.pathname == '/user/report') {
                        this.get_paye();
                    }
                    if (window.location.pathname == '/user/reshte' || window.location.pathname == '/user/dars' || window.location.pathname == '/user/teacher' || window.location.pathname == '/user/stu' || window.location.pathname == '/user/film' || window.location.pathname == '/user/report') {
                        this.get_reshte();
                    }
                    if (window.location.pathname == '/user/index') {
                        this.get_index();
                    }
                    this.logined = 1;
                    this.user_id = response.data.id
                    this.type = response.data.type
                    this.username = response.data.username
                    this.name = response.data.name
                } else {
                    // location.href = '/';
                    this.logined = '';
                }
            });
            // }
        },
        add_branch() {
            this.isLoading = true;
            axios
                .post('/user/add_branch', {
                    name: this.branch_name,
                    addr: this.branch_addr,
                    type: this.branch_type,
                    id: this.branch_id
                }).then(response => {
                    this.isLoading = false
                    this.get_branch();
                    Swal.fire('', response.data.mes, 'success')
                })
        },
        get_branch() {
            axios
                .get('/user/get_branch')
                .then(response => {
                    this.all_branch = response.data;
                })
        },
        delete_branch(branch_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_branch', {
                    id: branch_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_branch();
                    Swal.fire('', 'شعبه حذف شد', 'success')
                })
        },
        branch_edit(branch) {
            this.branch_id = branch.id;
            this.branch_name = branch.name;
            this.branch_addr = branch.addr;
            this.branch_type = branch.type;
        },
        // paye
        add_paye() {
            this.isLoading = true;
            axios
                .post('/user/add_paye', {
                    title: this.paye_name,
                    type: this.branch_type,
                    id: this.paye_id
                }).then(response => {
                    this.isLoading = false
                    this.get_paye();
                    Swal.fire('', response.data.mes, 'success')
                })
        },
        get_paye() {
            axios
                .get('/user/get_paye')
                .then(response => {
                    this.all_paye = response.data;
                })
        },
        delete_paye(paye_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_paye', {
                    id: paye_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_paye();
                    Swal.fire('', 'پایه حذف شد', 'success')
                })
        },
        paye_edit(paye) {
            this.paye_id = paye.id;
            this.paye_name = paye.title;
            this.branch_type = paye.type;
        },
        // reshte
        add_reshte() {
            this.isLoading = true;
            axios
                .post('/user/add_reshte', {
                    title: this.reshte_name,
                    id: this.reshte_id
                }).then(response => {
                    this.isLoading = false
                    this.get_reshte();
                    Swal.fire('', response.data.mes, 'success')
                })
        },
        get_reshte() {
            axios
                .get('/user/get_reshte')
                .then(response => {
                    this.all_reshte = response.data;
                })
        },
        delete_reshte(reshte_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_reshte', {
                    id: reshte_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_reshte();
                    Swal.fire('', 'رشته حذف شد', 'success')
                })
        },
        reshte_edit(reshte) {
            this.reshte_id = reshte.id;
            this.reshte_name = reshte.title;
        },
        // dars
        add_lesson() {
            this.isLoading = true;
            axios
                .post('/user/add_lesson', {
                    name: this.lesson_name,
                    status: this.branch_type,
                    paye_id: this.paye_id,
                    reshte_id: this.reshte_id,
                    id: this.lesson_id
                }).then(response => {
                    this.isLoading = false
                    this.get_lesson();
                    Swal.fire('', response.data.mes, 'success')
                })
        },
        change_paye(a = 0) {
            this.with_reshte = '';
            this.branch_type = 0;
            this.reshte_id = '';
            for (var i = 0; i < this.all_paye.length; i++) {
                if (this.all_paye[i].id == this.paye_id) {
                    this.all_paye[i].type == 1 ? this.with_reshte = 1 : this.with_reshte = '';
                    if (a == 1) {
                        this.get_lesson();
                    }
                    if (a == 2) {
                        this.get_lesson_teacher();
                    }
                }
            }
        },
        get_lesson(a = 0) {
            if (a == 1) {
                this.reshte_id = '';
            }
            this.all_lesson = [];
            this.isLoading = true
            axios
                .post('/user/get_lesson', {
                    status: this.branch_type,
                    paye_id: this.paye_id,
                    reshte_id: this.reshte_id,
                }).then(response => {
                    this.isLoading = false
                    this.all_lesson = response.data;
                })
        },
        get_lesson_stu() {
            this.all_lesson = [];
            this.isLoading = true
            axios
                .post('/user/get_lesson_stu', {
                    paye_id: this.paye_id,
                    reshte_id: this.reshte_id,
                }).then(response => {
                    this.isLoading = false
                    this.all_lesson = response.data;
                })
        },
        delete_lesson(lesson_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_lesson', {
                    id: lesson_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_lesson();
                    Swal.fire('', 'درس حذف شد', 'success')
                })
        },
        lesson_edit(lesson) {
            this.lesson_id = lesson.id;
            this.lesson_name = lesson.name;
            this.paye_id = lesson.p_id;
            this.reshte_id = lesson.r_id;
            this.branch_type = lesson.status;
        },
        // teacher
        add_teacher() {
            if (this.teacher_name && this.teacher_pass && this.teacher_user) {
                this.isLoading = true;
                axios
                    .post('/user/add_teacher', {
                        name: this.teacher_name,
                        username: this.teacher_user,
                        pass: this.teacher_pass,
                        id: this.teacher_id
                    }).then(response => {
                        this.isLoading = false
                        if (response.data.id) {
                            this.teacher_id = response.data.id;
                        }
                        this.reshte_id = '';
                        this.branch_id = '';
                        this.branch_type = 0;
                        this.lesson_id = '';
                        this.paye_id = '';
                        this.teacher_class = [];
                        this.get_teacher();
                        // Swal.fire('', response.data.mes, 'success')
                        // if (response.data.id) {
                        this.goto_class = 1;
                        if (response.data.id == undefined) {
                            this.get_teacher_class();
                        }
                    })
            } else {
                Swal.fire('', 'لطفا تمام فیلد ها را پر کنید', 'error')
            }

        },
        give_class_toteacher() {
            this.isLoading = true;
            axios
                .post('/user/give_class_toteacher', {
                    t_id: this.teacher_id,
                    b_id: this.branch_id,
                    p_id: this.paye_id,
                    r_id: this.reshte_id,
                    l_id: this.lesson_id,
                    id: ''
                }).then(response => {
                    this.isLoading = false
                    this.get_teacher_class();
                    // Swal.fire('', response.data.mes, 'success')
                })
        },
        get_teacher_class() {
            axios
                .post('/user/get_teacher_class', {
                    t_id: this.teacher_id
                })
                .then(response => {
                    this.teacher_class = response.data;
                })
        },
        delete_teacher_class(class_teacher_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_teacher_class', {
                    id: class_teacher_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_teacher_class();
                    Swal.fire('', 'کلاس حذف شد', 'success')
                })
        },
        get_teacher(a = 0) {
            if (a == 1) {
                if (!this.all_teacher.length) {
                    this.isLoading = true;
                    axios
                        .get('/user/get_teacher')
                        .then(response => {
                            this.isLoading = false;
                            this.all_teacher = response.data;
                        })
                }

            } else {
                axios
                    .get('/user/get_teacher')
                    .then(response => {
                        this.all_teacher = response.data;
                    })
            }
        },
        delete_teacher(teacher_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_teacher', {
                    id: teacher_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_teacher();
                    Swal.fire('', 'معلم حذف شد', 'success')
                })
        },
        teacher_edit(teacher) {
            this.teacher_id = teacher.id;
            this.teacher_name = teacher.name;
            this.teacher_user = teacher.username;
            this.teacher_pass = teacher.pass;
        },
        // stu
        add_stu() {
            if (this.stu_name && this.stu_pass && this.stu_user && this.paye_id) {
                this.isLoading = true;
                axios
                    .post('/user/add_stu', {
                        name: this.stu_name,
                        username: this.stu_user,
                        pass: this.stu_pass,
                        p_id: this.paye_id,
                        r_id: this.reshte_id,
                        id: this.stu_id
                    }).then(response => {
                        this.isLoading = false
                        this.get_lesson_stu();
                        if (response.data.id) {
                            this.stu_id = response.data.id;
                        }
                        this.branch_id = '';
                        this.branch_type = 0;
                        this.lesson_id = '';
                        this.stu_class = [];
                        this.get_stu();
                        this.goto_class = 1;
                        if (response.data.id == undefined) {
                            this.get_stu_class();
                        }
                    })
            } else {
                Swal.fire('', 'لطفا تمام فیلد ها را پر کنید', 'error')
            }

        },
        change_branch() {
            this.with_reshte = '';
            for (var i = 0; i < this.all_branch.length; i++) {
                if (this.all_branch[i].id == this.branch_id) {
                    this.all_branch[i].type == 1 ? this.with_reshte = 1 : this.with_reshte = '';
                    this.lesson_id = '';
                }
            }
        },
        give_class_tostu() {
            this.isLoading = true;
            axios
                .post('/user/give_class_tostu', {
                    s_id: this.stu_id,
                    b_id: this.branch_id,
                    l_id: this.lesson_id,
                }).then(response => {
                    this.isLoading = false
                    this.get_stu_class();
                    // Swal.fire('', response.data.mes, 'success')
                })
        },
        get_stu_class() {
            axios
                .post('/user/get_stu_class', {
                    s_id: this.stu_id
                })
                .then(response => {
                    this.stu_class = response.data;
                })
        },
        // متد پایین همون حذف کلاس دانش آموزه که اسمش اشتباه شده
        stu_teacher_class(class_stu_id) {
            this.isLoading = true;
            axios
                .post('/user/stu_teacher_class', {
                    id: class_stu_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_stu_class();
                    Swal.fire('', 'کلاس دانش آموز حذف شد', 'success')
                })
        },
        get_stu(a = 0) {
            if (a == 1) {
                if (!this.all_stu.length) {
                    this.isLoading = true;
                    axios
                        .get('/user/get_stu')
                        .then(response => {
                            this.isLoading = false;
                            this.all_stu = response.data;
                        })
                }

            } else {
                axios
                    .get('/user/get_stu')
                    .then(response => {
                        this.all_stu = response.data;
                    })
            }
        },
        delete_stu(stu_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_stu', {
                    id: stu_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_stu();
                    Swal.fire('', 'دانش آموز حذف شد', 'success')
                })
        },
        stu_edit(stu) {
            this.stu_id = stu.id;
            this.stu_name = stu.name;
            this.stu_user = stu.username;
            this.stu_pass = stu.pass;
            this.paye_id = stu.p_id;
            this.reshte_id = stu.r_id;
        },
        edit_active(stu) {
            var active;
            stu.active == 1 ? active = 0 : active = 1;

            this.isLoading = true
            axios
                .post('/user/edit_active', {
                    id: stu.id,
                    activ: active
                }).then(response => {
                    this.isLoading = false
                    this.get_stu();
                    active == 1 ?
                        Swal.fire('', 'وضعیت فعال شد', 'success')
                        :
                        Swal.fire('', 'وضعیت غیر فعال شد', 'success');
                })
        },
        // film
        change_lesson() {
            this.all_teacher = [];
            this.all_film = [];
            this.isLoading = true;
            axios
                .post('/user/change_lesson', {
                    l_id: this.lesson_id
                }).then(response => {
                    this.isLoading = false;
                    this.all_teacher = response.data;
                })
        },
        funcaddrfilm(val) {
            this.film_addr = val;
        },
        add_film() {
            if (this.film_name && this.film_addr && this.lesson_id && this.teacher_id) {
                this.isLoading = true;
                axios
                    .post('/user/add_film', {
                        title: this.film_name,
                        addr: this.film_addr,
                        l_id: this.lesson_id,
                        t_id: this.teacher_id,
                        id: ''
                    }).then(response => {
                        this.isLoading = false
                        this.goto_class = 1;
                        this.film_id = response.data.id;
                        // this.get_ids_spcial_film( response.data.id);
                        this.get_film();
                        this.all_special_film = response.data.special_film;
                        Swal.fire('', response.data.mes, 'success')
                    })
            } else {
                Swal.fire('', 'لطفا تمام فیلد ها را پر کنید', 'error')
            }
        },
        allow_show(b_id, s_id) {
            if (this.limit_times[s_id]) {
                this.isLoading = true
                axios
                    .post('/user/allow_show', {
                        film_id: this.film_id,
                        b_id: b_id,
                        s_id: s_id,
                        limit_time: this.limit_times[s_id]
                    }).then(response => {
                        Swal.fire('', response.data.mes, 'success')
                        this.specail_ids.push(s_id);
                        this.isLoading = false
                    })
            } else {
                Swal.fire('', 'لطفا تمام فیلد ها را پر کنید', 'error')
            }
        },
        get_film() {
            this.isLoading = true;
            axios
                .post('/user/get_film', {
                    l_id: this.lesson_id,
                    t_id: this.teacher_id,
                })
                .then(response => {
                    this.isLoading = false;
                    this.all_film = response.data;
                })
        },
        delete_film(film_id) {
            this.isLoading = true;
            axios
                .post('/user/delete_film', {
                    id: film_id
                }).then(response => {
                    this.isLoading = false;
                    this.get_film();
                    Swal.fire('', 'فیلم حذف شد', 'success')
                })
        },
        film_edit(film) {
            this.film_id = film.id;
            this.film_name = film.title;
            this.film_addr = film.addr;
        },
        edit_filmfunc() {
            if (this.film_name) {
                this.specail_ids = [];
                this.limit_times = [];
                this.isLoading = true;
                axios
                    .post('/user/edit_filmfunc', {
                        id: this.film_id,
                        title: this.film_name,
                        l_id: this.lesson_id,
                        t_id: this.teacher_id,
                    }).then(response => {
                        this.isLoading = false
                        this.goto_class = 1;
                        for (var i = 0; i < response.data.film_branch_ids.length; i++) {
                            this.specail_ids.push(response.data.film_branch_ids[i].tm_id);
                            this.limit_times[response.data.film_branch_ids[i].tm_id] = response.data.film_branch_ids[i].limit_time;
                        }

                        // this.get_ids_spcial_film( response.data.id);
                        this.get_film();
                        this.all_special_film = response.data.special_film;
                    })
            } else {
                Swal.fire('', 'لطفا تمام فیلد ها را پر کنید', 'error')
            }
        },
        exit_user() {
            this.isLoading = true;
            axios
                .get('/user/exit_user')
                .then(response => {
                    this.isLoading = false
                    location.href = "/";

                }, response => {
                    swal('خارج نشد')

                });
        },
        // report
        report_absent() {
            this.isLoading = true
            axios
                .post('/user/report_absent', {
                    film_id: this.film_id,
                    b_id: this.branch_id,
                }).then(response => {
                    this.isLoading = false
                    this.all_absent = response.data;
                })
        },
        // pass
        edit_pass_user() {
            if ((this.pass && this.new_pass && this.new_pass2) && this.new_pass == this.new_pass2) {
                this.isLoading = true
                axios
                    .post('/user/edit_pass', {
                        stu_id: this.user_id,
                        pass: this.pass,
                        new_pass: this.new_pass,
                    }).then(response => {
                        this.isLoading = false
                        Swal.fire('', response.data.mes, '');
                    })
            } else {
                Swal.fire('', 'کلمه عبور با تکرارش مطابقیت ندارد', 'warning');
            }
        },
        // *********************** student
        btn_menu() {
            if (this.i == 0) {
                $('#sidebar').css('margin-right', '-300px')
                this.i = 1;
            } else {
                $('#sidebar').css('margin-right', '0px')
                this.i = 0;
            }
        },
        stu_login() {
            this.isLoading = true;
            axios
                .post('/stu/login', {
                    username: this.username,
                    pass: this.pass

                }).then(response => {
                    this.isLoading = false;
                    if (response.data.username != undefined) {
                        if (response.data.active == 1) {
                            if (getCookie('user')) {
                                Swal.fire('', 'دانش آموز گرامی ' + response.data.name + ' شما وارد شدید', 'success');
                                location.href = "/stu/index";
                            } else {
                                Swal.fire('', 'این حساب فعال است', 'warning');
                            }
                        } else {
                            // set cookie
                            let d = new Date();
                            d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
                            let expires = "expires=" + d.toUTCString();
                            document.cookie = "user=" + response.data.username + ";" + expires + ";path=/"
                            Swal.fire('', 'دانش آموز گرامی ' + response.data.name + ' شما وارد شدید', 'success');
                            location.href = "/stu/index";
                        }

                    } else {
                        Swal.fire('', 'کاربر وجود ندارد', 'warning');

                    }

                }, response => {
                    this.isLoading = false;
                    Swal.fire('', 'مشکل در اتصال به سرور', 'warning');
                });
        },
        getstu() {
            axios
                .get('/stu/getstu')
                .then(response => {
                    if (response.data.username != undefined) {
                        if (window.location.pathname == '/stu/index') {
                            this.get_branch_stu(response.data.id, response.data.p_id, response.data.r_id);
                        }
                        if (window.location.pathname == '/stu/profile') {
                            this.get_profile_stu(response.data.id);
                        }
                        this.logined = 1;
                        this.stu_id = response.data.id
                        this.paye_id = response.data.p_id
                        this.reshte_id = response.data.r_id
                        this.username = response.data.username
                        this.name = response.data.name
                    } else {
                        this.logined = '';
                    }
                });
        },
        get_branch_stu(stu_id, p_id, r_id) {
            this.isLoading = true
            axios
                .post('/stu/get_branch_stu', {
                    id: stu_id,
                    p_id: p_id,
                    r_id: r_id
                }).then(response => {
                    this.isLoading = false;
                    this.status = response.data.status;
                    if (response.data.status == 0) {
                        this.all_branch = response.data.branch;
                    } else {
                        this.all_lesson = response.data.lesson;
                    }
                })
        },
        show_dars(b_id, type) {
            this.branch_id = b_id;
            this.isLoading = true
            axios
                .post('/stu/show_dars', {
                    s_id: this.stu_id,
                    b_id: b_id,
                    type: type,
                    p_id: this.paye_id,
                    r_id: this.reshte_id
                }).then(response => {
                    this.isLoading = false;
                    this.status = 1;
                    this.$router.push('/stu/lesson');
                    this.all_lesson = response.data.lesson;
                })
        },
        show_film(lesson_id) {
            this.message = '';
            this.isLoading = true
            axios
                .post('/stu/show_film', {
                    l_id: lesson_id,
                    b_id: this.branch_id,
                    p_id: this.paye_id,
                    r_id: this.reshte_id
                }).then(response => {
                    this.isLoading = false;
                    this.status = 2;
                    this.$router.push('/stu/film');

                    if (response.data.film != 0) {
                        console.log(response.data.film)
                        this.all_film = response.data.film;
                    } else {
                        this.message = 'هیچ فیلمی موجود نمیباشد';
                    }
                })
        },
        play_film(film_id) {
            this.isLoading = true
            axios
                .post('/stu/play_film', {
                    film_id: film_id,
                    stu_id: this.stu_id,
                    b_id: this.branch_id,
                }).then(response => {
                    this.isLoading = false;
                    this.status = 3;
                    this.$router.push('/stu/play_film');
                    this.film_addr = response.data.film.addr;
                    this.view_id = response.data.view_id;
                })
        },
        onEnd() {
            axios
                .post('/stu/onEnd', {
                    view_id: this.view_id,
                })
        },
        // profile
        get_profile_stu(id) {
            this.isLoading = true
            axios
                .post('/stu/get_profile_stu', {
                    id: id,
                }).then(response => {
                    this.name = response.data[0].name;
                    this.username = response.data[0].username;
                    this.paye_name = response.data[0].p_title;
                    this.reshte_name = response.data[0].r_title;
                    this.isLoading = false;
                })
        },
        // pass
        edit_pass() {
            if ((this.pass && this.new_pass && this.new_pass2) && this.new_pass == this.new_pass2) {
                this.isLoading = true
                axios
                    .post('/stu/edit_pass', {
                        stu_id: this.stu_id,
                        pass: this.pass,
                        new_pass: this.new_pass,
                    }).then(response => {
                        this.isLoading = false
                        Swal.fire('', response.data.mes, '');
                    })
            } else {
                Swal.fire('', 'کلمه عبور با تکرارش مطابقیت ندارد', 'warning');
            }
        },
        // **************************** teach
        teach_login() {
            this.isLoading = true;
            axios
                .post('/teacher/login', {
                    username: this.username,
                    pass: this.pass

                }).then(response => {
                    this.isLoading = false;
                    if (response.data.username != undefined) {
                        Swal.fire('', ' استاد گرامی ' + response.data.name + ' شما وارد شدید', 'success');
                        location.href = "/teacher/index";
                    } else {
                        Swal.fire('', 'کاربر وجود ندارد', 'warning');

                    }

                }, response => {
                    this.isLoading = false;
                    Swal.fire('', 'مشکل در اتصال به سرور', 'warning');
                });
        },
        getteach() {
            axios
                .get('/teacher/getteach')
                .then(response => {
                    if (response.data.username != undefined) {
                        this.teacher_id = response.data.id
                        if (window.location.pathname == '/teacher/index') {
                            this.get_paye_teacher(response.data.id);
                        }
                        if (window.location.pathname == '/teacher/dars') {
                            this.get_branch_teacher(response.data.id);
                        }
                        if (window.location.pathname == '/teacher/plan') {
                            this.get_teacher_class();
                        }
                        this.logined = 1;
                        this.username = response.data.username
                        this.name = response.data.name
                    } else {
                        this.logined = '';
                    }
                });
        },
        get_paye_teacher(teacher_id, b = 0) {
            if (b == 0) {
                this.isLoading = true
                axios
                    .post('/teacher/get_paye_teacher', {
                        id: teacher_id
                    })
                    .then(response => {
                        this.isLoading = false
                        this.all_paye = response.data;
                    })
            } else {
                this.isLoading = true
                axios
                    .post('/teacher/get_paye_teacher', {
                        id: teacher_id,
                        branch_id: this.branch_id,
                    })
                    .then(response => {
                        this.isLoading = false
                        this.all_paye = response.data;
                    })
            }

        },
        get_lesson_teacher() {
            this.all_lesson = [];
            this.isLoading = true
            axios
                .post('/teacher/get_lesson_teacher', {
                    id: this.teacher_id,
                    paye_id: this.paye_id,
                    reshte_id: this.reshte_id,
                }).then(response => {
                    this.isLoading = false
                    this.all_lesson = response.data;
                })
        },
        get_reshte_teacher() {
            this.isLoading = true;
            if (this.branch_type == 1) {
                axios
                    .post('/teacher/get_reshte_teacher', {
                        id: this.teacher_id,
                        paye_id: this.paye_id,
                    }).then(response => {
                        this.all_reshte = response.data;
                    })
            } else {
                this.reshte_id = '';
            }
            this.isLoading = false
            this.get_lesson_teacher();
        },
        get_branch_teacher(id) {
            this.isLoading = true;
            axios
                .post('/teacher/get_branch_teacher', {
                    id: id,
                }).then(response => {
                    this.isLoading = false
                    this.all_branch = response.data;
                })
            this.get_lesson_teacher();
        },
        edit_pass_teacher() {
            if ((this.pass && this.new_pass && this.new_pass2) && this.new_pass == this.new_pass2) {
                this.isLoading = true
                axios
                    .post('/teacher/edit_pass_teacher', {
                        stu_id: this.teacher_id,
                        pass: this.pass,
                        new_pass: this.new_pass,
                    }).then(response => {
                        this.isLoading = false
                        Swal.fire('', response.data.mes, '');
                    })
            } else {
                Swal.fire('', 'کلمه عبور با تکرارش مطابقیت ندارد', 'warning');
            }
        },
    },
});
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
