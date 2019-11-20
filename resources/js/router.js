import Vue from 'vue';
import Router from 'vue-router'

/** pages */
import Login from './pages/Login.vue';
import Home from './pages/Home.vue';
import BookmarkDetail from './pages/BookmarkDetail.vue';
import ComposePlan from './pages/ComposePlan.vue';
import PhotoList from './pages/PhotoList.vue';

Vue.use(Router);

const routes = [
    { path: '/login', component: Login },
    { path: '/photrip/home', component: Home },
    { path: '/photrip/bookmark/detail', component: BookmarkDetail },
    { path: '/photrip/compose/plan', component: ComposePlan },
    { path: '/photrip/photo', component: PhotoList },
];

export default new Router({
    mode:'history',
    linkActiveClass: 'active',
    routes
});
