import './bootstrap';
import '../sass/frontend/main.sass';

import jQuery from 'jquery';

window.$ = jQuery;


import {createApp} from 'vue/dist/vue.esm-bundler'
import  store  from './store/index';

import Home from './components/home/Index.vue';
import HaderMain from './components/header/Main.vue';
import FooterMain from './components/footer/Main.vue';

import FormCode from './components/register/Code.vue';
import FormRegister from './components/register/Register.vue';
import FormThank from './components/register/ThankYou.vue';
import FormError from './components/register/ErrorForm.vue';

const app = createApp({});

app.component('home-page',Home);
app.component('header-main',HaderMain);
app.component('footer-main',FooterMain);

app.component('form-code',FormCode);
app.component('form-register',FormRegister);
app.component('form-thank',FormThank);
app.component('form-error',FormError);
app.use(store);
app.mount('#app');
