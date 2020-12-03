import Vue from 'vue';
import VueRouter from 'vue-router';
import Main from '../components/Main.vue'
import Test from '../components/partials/Test.vue'
import NotFound from '../components/partials/NotFound.vue'

Vue.use(VueRouter);

export default new VueRouter({
    
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Main
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