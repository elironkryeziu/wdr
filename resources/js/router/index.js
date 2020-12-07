import Vue from 'vue';
import VueRouter from 'vue-router';
import Main from '../components/Main.vue'
import Test from '../components/partials/Test.vue'
import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';
import Profile from '../components/profile/Profile.vue';
import NotFound from '../components/partials/NotFound.vue'

Vue.use(VueRouter);

export default new VueRouter({
    
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Main
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/test',
            component: Test
        },
        {
            path: '*',
            component: NotFound
        },
    ]
});