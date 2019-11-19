import Vue from 'vue';
import Router from 'vue-router'
import Example from './components/ExampleComponent.vue';

Vue.use(Router);

const routes = [
    { path: '/', component: Example }
];

export default new Router({
    mode:'history',
    linkActiveClass: 'active',
    routes
});
