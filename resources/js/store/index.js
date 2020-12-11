import Vuex from "vuex";
import Vue from "vue";
import user from './user/index'
import shared from './shared/index'
import aw from './aw/index'
import workers from './workers/index'
import default_tasks from './default_tasks/index'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user,
        aw,
        workers,
        default_tasks,
        shared
    }
});