
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform'
import VueProgressBar from 'vue-progressbar'

import Snotify, { SnotifyPosition } from 'vue-snotify'
import 'vue-snotify/styles/material.css'
window.Form = Form

const SnotifyOptions = {
    toast: {
        position: SnotifyPosition.rightTop
    }
}
Vue.use(Snotify, SnotifyOptions);

const VueProgressBarOptions = {
    color: '#50d38a',
    failedColor: '#87111d',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};
Vue.use(VueProgressBar, VueProgressBarOptions);

import CourseComponent from './components/CourseComponent.vue'
Vue.component('course-component', CourseComponent);

import PaginationComponent from './components/partial/PaginationComponent.vue'
Vue.component('pagination', PaginationComponent);

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

import Toasted from 'vue-toasted';
Vue.use(Toasted)

import BModal from 'bootstrap-vue/es/components/modal/modal'
Vue.component('b-modal', BModal);

import BButton from 'bootstrap-vue/es/components/button/button'
Vue.component('b-button', BButton);

import BToast from 'bootstrap-vue/es/components/toast/toast'
Vue.component('b-toast', BToast)

import Categories from './components/CategoriesComponent';
Vue.component('categories', Categories);

import Category from './components/CategoryComponent';
Vue.component('category', Category);

//Componentes listos para presentarse
import Status from './components/StatusComponent';
Vue.component('status-component', Status);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
