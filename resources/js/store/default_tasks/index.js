import axios from 'axios'

const state = {
    default_tasks: [],
    default_task: {}
};

const getters = {
    
}; 

const mutations = {
    SET_DEFAULT_TASKS(state, default_tasks) {
        state.default_tasks = default_tasks;      
    },
    SET_DEFAULT_TASK(state, default_task) {
        state.default_task = default_task;      
    },
};

const actions = {
    getDefaultTasks(context) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");
  
        axios.get(`api/default-tasks`).then(response => {
            // console.log(response)
          context.commit('SET_DEFAULT_TASKS', response.data)
        })
        .catch(error => { console.log(error) })
    },

    createDefaultTask(context, default_task) {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + localStorage.getItem("access_token");
    
        axios.post(`api/default-tasks`, {
            default_task: default_task
        })
        .then(() => {
            context.commit('SET_DEFAULT_TASKS', default_task)
        })
        .finally(() => {
            context.dispatch('getDefaultTasks');
        })
        .catch(error => { console.log(error) })
    },

    getDefaultTask(context, {id}) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.get(`api/default-task/${id}`).then(response => {
            // console.log(response);
            context.commit('SET_DEFAULT_TASK', response.data)
        })
        .catch(error => { console.log(error) })
    },

    updateDefaultTask(context, default_task) {
        // console.log(task.task.id);
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.put(`api/default-task/${default_task.default_task.id}`, {
            default_task: default_task            
        })
        .then(() => {
            context.commit('SET_DEFAULT_TASK', default_task);
        })
        .catch(error => { console.log(error)
        })
        .finally(()=>{
            context.dispatch('getDefaultTasks');
        })
    },
    deleteDefaultTask(context, {id}) {
        // console.log(id);
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.delete(`api/default-task/${id}`).then(() => {
            // context.commit('SET_TASK', task);
        })
        .catch(error => { console.log(error)
        })
        .finally(()=>{
            context.dispatch('getDefaultTasks');
        })
    },
};


export default {
    state,
    getters,
    actions,
    mutations
};