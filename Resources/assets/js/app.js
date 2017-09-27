require('./../scss/styling.scss');
require('./bootstrap');

window.Vue = require('vue');

export const EventBus = new Vue();

Vue.component('App', require('../vue/App.vue'));

const app = new Vue({
    el: '#app'
});