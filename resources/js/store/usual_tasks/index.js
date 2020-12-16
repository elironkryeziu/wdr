import axios from 'axios'

const state = {
    usual_tasks: [],
    usual_task:{},
    daily_tasks: [],
    daily_task: {},
    weekly_tasks: [],
    weekly_task: {},
    monthly_tasks: [],
    monthly_task: {},
    type: ''
};

const getters = {
    
}; 

const mutations = {
    SET_USUAL_TASKS(state, usual_tasks) {
        state.usual_tasks = usual_tasks;      
    },
    SET_USUAL_TASK(state, usual_task) {
        state.usual_task = usual_task;      
    },

    SET_DAILY_TASKS(state, daily_tasks) {
        state.daily_tasks = daily_tasks;      
    },
    SET_DAILY_TASK(state, daily_task) {
        state.daily_task = daily_task;      
    },

    SET_WEEKLY_TASKS(state, weekly_tasks) {
        state.weekly_tasks = weekly_tasks;
    },
    SET_WEEKLY_TASK(state, weekly_task) {
        state.weekly_task = weekly_task;
    },

    SET_MONTHLY_TASKS(state, monthly_tasks) {
        state.monthly_tasks = monthly_tasks;
    },
    SET_MONTHLY_TASK(state, monthly_task) {
        state.monthly_task = monthly_task;
    },
    SET_TYPE(state, type) {
        state.type = type;
    }
};

const actions = {
    getUsualTasks(context) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");
  
        axios.get(`api/usual-tasks`).then(response => {
            console.log(response.data);
            context.commit('SET_USUAL_TASKS', response.data.usual_tasks)
            context.commit('SET_DAILY_TASKS', response.data.daily_tasks)
            context.commit('SET_WEEKLY_TASKS', response.data.weekly_tasks)
            context.commit('SET_MONTHLY_TASKS', response.data.monthly_tasks)
        })
        .catch(error => { console.log(error) })
    },

    // createDefaultTask(context, default_task) {
    //     axios.defaults.headers.common["Authorization"] =
    //         "Bearer " + localStorage.getItem("access_token");
    
    //     axios.post(`api/default-tasks`, {
    //         default_task: default_task
    //     })
    //     .then(() => {
    //         context.commit('SET_DEFAULT_TASKS', default_task)
    //     })
    //     .finally(() => {
    //         context.dispatch('getDefaultTasks');
    //     })
    //     .catch(error => { console.log(error) })
    // },

    getUsualTask(context, {id}) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.get(`api/usual-task/${id}`).then(response => {
            // console.log(response.data.data.type);
            
            context.commit('SET_TYPE', response.data.data.type);
            if(response.data.data.type == 'daily') 
            {
                context.commit('SET_USUAL_TASK', response.data.data);
            } 
            else if(response.data.data.type == 'weekly') 
            {
                context.commit('SET_WEEKLY_TASKS', response.data.data);
            } 
            else if(response.data.data.type == 'monthly')
            {
                context.commit('SET_MONTHLY_TASKS', response.data.data);
            } 
            else 
            {
                
            }
            // context.commit('SET_DAILY_TASK', response.data.daily_tasks)
            // context.commit('SET_WEEKLY_TASK', response.data.weekly_tasks)
            // context.commit('SET_MONTHLY_TASK', response.data.monthly_tasks)
        })
        .catch(error => { console.log(error) })
    },

    // updateDefaultTask(context, default_task) {
    //     // console.log(task.task.id);
    //     axios.defaults.headers.common["Authorization"] =
    //       "Bearer " + localStorage.getItem("access_token");

    //     axios.put(`api/default-task/${default_task.default_task.id}`, {
    //         default_task: default_task            
    //     })
    //     .then(() => {
    //         context.commit('SET_DEFAULT_TASK', default_task);
    //     })
    //     .catch(error => { console.log(error)
    //     })
    //     .finally(()=>{
    //         context.dispatch('getDefaultTasks');
    //     })
    // },
    // deleteDefaultTask(context, {id}) {
    //     // console.log(id);
    //     axios.defaults.headers.common["Authorization"] =
    //       "Bearer " + localStorage.getItem("access_token");

    //     axios.delete(`api/default-task/${id}`).then(() => {
    //         // context.commit('SET_TASK', task);
    //     })
    //     .catch(error => { console.log(error)
    //     })
    //     .finally(()=>{
    //         context.dispatch('getDefaultTasks');
    //     })
    // },
};


export default {
    state,
    getters,
    actions,
    mutations
};