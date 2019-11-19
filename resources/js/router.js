import Vue from 'vue';
import Router from 'vue-router'

/** pages */
import Login from './pages/Login.vue';
import Home from './pages/Home.vue';
import BookmarkDetail from './pages/BookmarkDetail.vue';

Vue.use(Router);

const routes = [
    { path: '/login', component: Login },
    { path: '/memoria/home', component: Home },
    { path: '/memoria/bookmark/detail', component: BookmarkDetail },
];

export default new Router({
    mode:'history',
    linkActiveClass: 'active',
    routes
});
