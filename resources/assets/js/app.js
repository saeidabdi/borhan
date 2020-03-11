
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Swal from 'sweetalert2'
import axios from 'axios';

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data:{
        username:'',pass:'',logined:'',name,admin:0,user_id:''
    },
    mounted() {
        this.getuser();
    },
    methods:{
        login(){
            axios.
                post('/admin/login',{
                    username : this.username,
                    pass : this.pass
                    }).then(response=>{
                        if(response.data.name){
                            this.logined = 1;
                            this.name = response.data.name;
                            if(response.data.type == 1){
                                this.admin = 1;
                                Swal.fire('', 'مدیر گرامی '+this.name+' وارد شدید', 'success');
                                location.href = '/admin'
                                return;
                            }
                            Swal.fire('سلام', 'شما وارد شدید!', 'success')
                        }else{
                            Swal.fire('سلام', 'کاربر وجود ندارد!', 'error')
                        }
                        
                    })
        },
        getuser() {
            axios.get('/getuser').then(response => {
                if (response.data.username != undefined) {
                    this.logined = 1;
                    this.name = response.data.name
                    this.user_id = response.data.id

                    if (response.data.type == 1) {
                        this.admin = 1;
                        return;
                    }
                } else {
                    this.logined = '';
                }
            });
        }
    }
});
