require('./bootstrap');

window.Vue = require('vue').default;

Vue.prototype.$http = window.axios;


import TreeTable from 'primevue/treetable';
import Column from 'primevue/column';
import Calendar from 'primevue/calendar';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import CascadeSelect from 'primevue/cascadeselect';
import Dropdown from 'primevue/dropdown';
import ColumnGroup from 'primevue/columngroup';
import DataTable from 'primevue/datatable';
import Password from 'primevue/password';
import ConfirmationService from 'primevue/confirmationservice';
import ConfirmDialog from 'primevue/confirmdialog';
import Dialog from 'primevue/dialog';
import FileUpload from 'primevue/fileupload';
import Card from 'primevue/card';
import ImagePreview from 'primevue/imagepreview';
import ToastService from 'primevue/toastservice';
import MegaMenu from 'primevue/megamenu';
import NotFound from "./components/NotFound";

import Navbar from './Backend/Pages/Navbar';


Vue.component('App', require('./components/App.vue').default);
Vue.component('login-form', require('./Backend/Pages/LoginForm.vue').default);
Vue.component('TreeTable', TreeTable);
Vue.component('Column', Column);
Vue.component('Calendar', Calendar);
Vue.component('Button', Button);
Vue.component('InputText', InputText);
Vue.component('CascadeSelect', CascadeSelect);
Vue.component('Dropdown', Dropdown);
Vue.component('ColumnGroup', ColumnGroup);
Vue.component('DataTable', DataTable);
Vue.component('Password', Password);
Vue.component('ConfirmDialog', ConfirmDialog);
Vue.component('Dialog', Dialog);
Vue.component('FileUpload', FileUpload);
Vue.component('Card', Card);
Vue.component('ImagePreview', ImagePreview);
Vue.component('MegaMenu', MegaMenu);
Vue.use(ConfirmationService);
Vue.use(NotFound);
Vue.use(ToastService);
Vue.component('Navbar', Navbar);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueAuth from '@websanova/vue-auth';
import router from './router'

Vue.axios = window.axios;

Vue.use(VueAuth, {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    loginData: {url: '/api/auth/login', method: 'POST', redirect: '', fetchUser: true},
    // fetchData: {url: '/api/auth/user', method: 'GET'},
});

import VueRouter from 'vue-router';
import { routes } from './router/routes';
import PrimeVue from 'primevue/config';

Vue.use(PrimeVue);
Vue.use(VueRouter);

// const router = new VueRouter({
//     mode: 'history',
//     routes
// });

const app = new Vue({
    el: '#app',
    router
});
