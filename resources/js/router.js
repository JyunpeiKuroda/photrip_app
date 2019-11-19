import Vue from 'vue';
import Router from 'vue-router'
import Example from './components/ExampleComponent.vue';

/** pages */
import Login from './pages/Login.vue';
import Home from './pages/Home.vue';

Vue.use(Router);

const routes = [
    { path: '/', component: Example },
    { path: '/login', component: Login },
    { path: '/memoria/home', component: Home },
];

export default new Router({
    mode:'history',
    linkActiveClass: 'active',
    routes
});
