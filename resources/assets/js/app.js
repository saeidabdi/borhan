
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Swal from 'sweetalert2'
import axios from 'axios';

window.Vue = require('vue');
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        name: '', username: '', pass: '', logined: '', isLoading: false,type:'',branch_name:'',branch_addr:'',branch_type:0,all_branch:[],

    },
    mounted() {
        this.getuser();
    },
    components: {
        Loading
    },
    methods: {
        // user
        admin_login() {
            this.isLoading = true;
            axios
                .post('/user/login', {
                    username: this.username,
                    pass: this.pass

                }).then(response => {
                    this.isLoading = false;
                    if (response.data.username != undefined) {
                        Swal.fire('','مدیر گرامی ' + response.data.name + ' شما وارد شدید','success');
                        location.href = "/user/index";

                    } else {
                        Swal.fire('','کاربر وجود ندارد','warning');

                    }

                }, response => {
                    this.isLoading = false;
                    Swal.fire('','مشکل در اتصال به سرور','warning');
                });
        },
        getuser() {
            // if (window.location.pathname != '/') {
            axios.get('/user/getuser').then(response => {
                if (response.data.username != undefined) {
                    if (window.location.pathname == '/user/branch') {
                        this.get_branch();
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
        add_branch(){
            this.isLoading = true;
            axios
                .post('/user/add_branch',{
                    name : this.branch_name,
                    addr : this.branch_addr,
                    type : this.branch_type
                }).then(response=>{
                    this.isLoading=false
                    this.get_branch();
                    Swal.fire('',response.data.mes,'success')
                })
        },
        get_branch(){
            axios
                .get('/user/get_branch')
                .then(response=>{
                    this.all_branch = response.data;
                })
        },
    }
});
