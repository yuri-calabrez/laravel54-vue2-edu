
require('./bootstrap');

window.Vue = require('vue');


Vue.component('class-student', require('./components/class_information/ClassStudent.vue'));

const app = new Vue({
    el: '#app'
});