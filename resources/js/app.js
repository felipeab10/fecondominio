/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';
// ES6 Modules or TypeScript
import swal from 'sweetalert2'
import moment from 'moment'
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '10px'
})

Vue.filter('dateDisplay',function(dtBrasil){
      return moment(dtBrasil).format('DD/MM/YYYY');
});

Vue.filter('UpText',function(text){
      return text.charAt(0).toUpperCase() + text.slice(1)
});

const toast = swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 5000
});

window.toast= toast;
window.swal = swal;
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router'
Vue.use(VueRouter)



let routes = [
    { path: '/user-dashboard', component: require('./components/User-Dashboard.vue').default },
    { path: '/adm-dashboard', component: require('./components/Adm-Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/users-admin', component: require('./components/Users-Admin.vue').default },
    { path: '/adm-condominio', component: require('./components/Adm-Condominio.vue').default }
  ]

  const router = new VueRouter({
   // mode: 'history', habilita o encurtamento da url, fazendo uma rota padrão
    linkActiveClass: 'active',
    routes // short for `routes: routes`
  })
  

window.Fire = new Vue();


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router
}).$mount('#app')
