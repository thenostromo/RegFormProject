import Vue from 'vue/dist/vue.js';
import RegFormApp from './RegFormApp.vue';
import Vuelidate from 'vuelidate'
import VueClip from 'vue-clip'

Vue.use(VueClip);
Vue.use(Vuelidate);
var app = new Vue({
    el: '#app',
    template: '<RegFormApp/>',
    components: { RegFormApp : RegFormApp }
});
