require('./bootstrap');

window.Vue = require('vue').default;

window.eventHub = new Vue();

Vue.prototype.$eventHub = window.eventHub;
Vue.prototype.$http = window.axios;

//Vuei18n
import VueI18n from 'vue-i18n'
import tr from './lang/tr';
import en from './lang/en';
Vue.use(VueI18n);

let userLang = navigator.language || navigator.userLanguage;
let userlangText = userLang.substring(0, 2);

let locale = userlangText;

const i18n = new VueI18n({
    locale,
    messages: locale === 'tr' ? tr : en,
});

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
import Menu from 'primevue/menu';
import Sidebar from 'primevue/sidebar';
import Galleria from 'primevue/galleria';
import Carousel from 'primevue/carousel';
import InputSwitch from 'primevue/inputswitch';
import Editor from 'primevue/editor';
import PanelMenu from 'primevue/panelmenu';


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
Vue.component('Menu', Menu);
Vue.component('Sidebar', Sidebar);
Vue.component('Galleria', Galleria);
Vue.component('Carousel', Carousel);
Vue.component('InputSwitch', InputSwitch);
Vue.component('Editor', Editor);
Vue.component('PanelMenu', PanelMenu);
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
    i18n,
    el: '#app',
    router
});
