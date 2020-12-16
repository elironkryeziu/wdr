import Vuex from "vuex";
import Vue from "vue";
import user from './user/index'
import aw from './aw/index'
import workers from './workers/index'
import default_tasks from './default_tasks/index'
import usual_tasks from './usual_tasks/index'
import plan from './plan/index'

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,
    modules: {
        user,
        aw,
        workers,
        default_tasks,
        usual_tasks,
        plan
    }
});