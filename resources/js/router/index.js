import Vue from 'vue';
import VueRouter from 'vue-router';
import Main from '../components/Main.vue'
import Workers from '../components/workers/Workers.vue'
import DefaultTasks from '../components/default_tasks/DefaultTasks.vue';
import UsualTasks from '../components/usual_tasks/UsualTasks.vue';
import Plan from '../components/plan/Plan.vue';
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
            component: Main,
            meta: {
                requiresAuth: true
            }
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
            path: '/workers',
            name: 'workers',
            component: Workers,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/default-tasks',
            name: 'default-tasks',
            component: DefaultTasks,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/usual-tasks',
            name: 'usual-tasks',
            component: UsualTasks,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/plan',
            name: 'plan',
            component: Plan,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '*',
            component: NotFound
        },
    ]
});