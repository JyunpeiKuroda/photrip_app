import Vue from 'vue';
import router from './router'
import store from './store'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy);

require('./bootstrap');
window.Vue = require('vue');

const app = new Vue({
    router,
    store,
    el: '#app',
});

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.auth)) {
//         if (store.getter['auth/check']) {
//             next()
//         } else {
//             next('/login')
//         }
//     }
// });