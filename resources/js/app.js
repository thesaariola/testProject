
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('navbar', require('./components/NavBar.vue').default);
Vue.component('blogpost', require('./components/BlogPost.vue').default);
Vue.component('commentpost', require('./components/CommentPost.vue').default);

const app = new Vue({
    el: '#app',
    
});
