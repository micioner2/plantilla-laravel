/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


Vue.component('inicio', require('./components/Inicio.vue').default);
Vue.component('pregunta', require('./components/Pregunta.vue').default);


const app = new Vue({
    el: '#app',
    data :{
        menu: 0,
        enlace: 'http://localhost:8080/biblioteca/public'
    }
});
