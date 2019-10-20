import Vue from 'vue';
import RegFormApp from './RegFormApp.vue';

var app = new Vue({
    el: '#app',
    template: '<RegFormApp/>',
    components: { RegFormApp : RegFormApp }
});
