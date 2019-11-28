import Vue from 'vue';
import Router from 'vue-router'
import store from './store' 

/** pages */
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import Home from './pages/Home.vue';
import GuideDetail from './pages/GuideDetail.vue';
import ComposePlan from './pages/ComposePlan.vue';
import PhotoList from './pages/PhotoList.vue';
import EditPlan from './pages/EditPlan.vue';
import NotPageError from './pages/NotPageError.vue';

Vue.use(Router);

const routes = [
    { 
        path: '/login', 
        component: Login,
        beforeEnter(to, from, next) {
            if (store.getters['auth/check']) {
              next('/photrip/home')
            } else {
              next()
            }
        }
    },
    { 
        path: '/register', 
        component: Register,
        beforeEnter(to, from, next) {
            if (store.getters['auth/check']) {
              next('/photrip/home')
            } else {
              next()
            }
        }
    },
    { path: '/photrip/home', component: Home, meta: {auth: true} },
    { path: '/photrip/guide/detail', component: GuideDetail, meta: {auth: true} },
    { path: '/photrip/compose/plan', component: ComposePlan, meta: {auth: true} },
    { path: '/photrip/photo', component: PhotoList, meta: {auth: true} },
    { path: '/photrip/edit/plan', component: EditPlan, meta: {auth: true} },
    { path: '/photrip/errorpage', component: NotPageError },
    { path: '*', redirect: '/photrip/errorpage' },
];


export default new Router({
    mode:'history',
    linkActiveClass: 'active',
    routes
});

