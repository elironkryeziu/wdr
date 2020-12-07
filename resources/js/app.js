import Vue from 'vue'
import App from './components/App.vue';
import store from "./store/index.js";
import router from './router/index'


router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!store.getters.loggedIn) {
        next({
          path: "/login",
          query: { redirect: to.fullPath },
        });
      } else {
        next();
      }
    } else {
      next(); // make sure to always call next()!
    }
});

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        App
    },
});
