/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 import { createApp } from 'vue';
 import Header from './Header.vue';
 import router from './router';
 createApp(Header).use(router).mount('#app');
