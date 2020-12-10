import Vue from 'vue'
import App from './components/App.vue';
import store from "./store/index.js";
import router from './router/index'
import VModal from 'vue-js-modal'
import VCalendar from 'v-calendar';
import moment from 'moment'



Vue.use(VModal);
Vue.use(require('vue-moment'));
Vue.use(VCalendar, {
  componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
});

Vue.filter('timeformat', (arg)=>{
  if(arg == null) 
  {
    return null;
  }else
  {
    return moment(arg, "HH:mm:ss").format('LT');
  }
});

Vue.filter('duration', (arg1, arg2)=>{
  if(arg1 == null || arg2 == null)  
  {
    return null;
  } else
  {
    let start = moment(arg1, "HH:mm:ss");
    let finish = moment(arg2, "HH:mm:ss");
    let duration = moment.duration(finish.diff(start));
    let string;
    if (duration.hours()>0)
    {
      if (duration.minutes()>0)
      {
        string = duration.hours()+" HOURS AND "+duration.minutes() +" MINUTES";
      } else 
      {
        string = duration.hours()+" HOURS";
      }
    } else
    {
      string = duration.minutes()+" MINUTES";
    }
    return string;
  }
});

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
