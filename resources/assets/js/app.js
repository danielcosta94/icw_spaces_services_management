
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../../public/css/jquery-ui.css');
require('../../../public/js/jquery-1.12.4');
require('../../../public/js/jquery-ui');

window.Vue = require('vue');

require('./plugins/sweet-alert-plugin');

var VueRange = require('vue-for-range');
Vue.use(VueRange);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('book-form', require('./components/BookForm.vue'));

const app = new Vue({
    el: '#app',
    http: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    },
});
