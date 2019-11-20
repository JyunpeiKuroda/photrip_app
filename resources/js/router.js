import Vue from 'vue';
import Router from 'vue-router'

/** pages */
import Login from './pages/Login.vue';
import Home from './pages/Home.vue';
import BookmarkDetail from './pages/BookmarkDetail.vue';
import ComposePlan from './pages/ComposePlan.vue';
import PhotoList from './pages/PhotoList.vue';
import EditPlan from './pages/EditPlan.vue';
import NotPageError from './pages/NotPageError.vue';

Vue.use(Router);

const routes = [
    { path: '/login', component: Login },
    { path: '/photrip/home', component: Home },
    { path: '/photrip/bookmark/detail', component: BookmarkDetail },
    { path: '/photrip/compose/plan', component: ComposePlan },
    { path: '/photrip/photo', component: PhotoList },
    { path: '/photrip/edit/plan', component: EditPlan },
    { path: '*', component: NotPageError },
];

export default new Router({
    mode:'history',
    linkActiveClass: 'active',
    routes
});
