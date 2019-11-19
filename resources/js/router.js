import Vue from 'vue';
import Router from 'vue-router'
import Example from './components/ExampleComponent.vue';
import Login from './pages/Login.vue';

Vue.use(Router);

const routes = [
    { path: '/', component: Example },
    { path: '/login', component: Login }
];

export default new Router({
    mode:'history',
    linkActiveClass: 'active',
    routes
});
