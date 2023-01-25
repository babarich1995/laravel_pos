

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//route imported
import {routes} from './routes'

//import App

import App from './views/App'
//import helpers

import User from './helpers/User'
window.User = User

import Notification from './helpers/Notification'
window.Notification = Notification

//sweet alert start

import Swal from 'sweetalert2';

window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.Toast = Toast
//swert alert end

window.Reload= new Vue;

const router = new VueRouter({
    mode:'history',
    routes
})
const app = new Vue({
    el: '#app',
  components:{App},
    router
});
