/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import App from './views/App'
import Profile from './views/Profile'
import Home from './views/Home'
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/profile/:name',
            name: 'profile',
            component: Profile,
        },
    ],
});
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
