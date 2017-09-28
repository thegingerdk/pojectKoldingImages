require('./../scss/styling.scss');
require('./bootstrap');

window.Vue = require('vue');

export const EventBus = new Vue();

Vue.component('Home', require('../vue/Home.vue'));
Vue.component('sPicture', require('../vue/Picture.vue'));

const app = new Vue({
    el: '#app'
});