import Vue from 'vue/dist/vue.js';
import AuthFormApp from './AuthFormApp.vue';
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);
var app = new Vue({
    el: '#app',
    template: '<AuthFormApp/>',
    components: { AuthFormApp : AuthFormApp }
});
