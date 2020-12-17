import axios from 'axios'

const state = {
    usual_tasks: [],
    usual_task:{},
    daily_tasks_tomorrow: [],
    daily_task_tomorrow:{},
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

    SET_DAILY_TASKS_TOMORROW(state, daily_tasks_tomorrow) {
        state.daily_tasks_tomorrow = daily_tasks_tomorrow;      
    },
    SET_DAILY_TASK_TOMORROW(state, daily_task_tomorrow) {
        state.daily_task_tomorrow = daily_task_tomorrow;      
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
            context.commit('SET_USUAL_TASKS', response.data.usual_tasks)
            context.commit('SET_DAILY_TASKS', response.data.daily_tasks)
            context.commit('SET_DAILY_TASKS_TOMORROW', response.data.daily_tasks_tomorrow)
            context.commit('SET_WEEKLY_TASKS', response.data.weekly_tasks)
            context.commit('SET_MONTHLY_TASKS', response.data.monthly_tasks)
        })
        .catch(error => { console.log(error) })
    },

    createTask(context, task) {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + localStorage.getItem("access_token");
        
        // console.log(task);
        axios.post(`api/usual-tasks`, {
            task: task
        })
        .then(() => {
            context.commit('SET_USUAL_TASKS', task);
            context.commit('SET_DAILY_TASKS', task);
            context.commit('SET_DAILY_TASKS_TOMORROW', task);
            context.commit('SET_WEEKLY_TASKS', task);
            context.commit('SET_MONTHLY_TASKS', task);
        })
        .finally(() => {
            context.dispatch('getUsualTasks');
        })
        // .catch(error => { console.log(error) })
    },

    getUsualTask(context, {id,type}) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.get(`api/usual-task/${type}/${id}`).then(response => {

            if(type == 'daily') 
            {
                context.commit('SET_DAILY_TASK', response.data.data);
            } 
            else if(type == 'weekly') 
            {
                context.commit('SET_WEEKLY_TASK', response.data.data);
            } 
            else if(type == 'monthly')
            {
                context.commit('SET_MONTHLY_TASK', response.data.data);
            } 
            else 
            {
                context.commit('SET_USUAL_TASK', response.data.data);
            }
        })
        .catch(error => { console.log(error) })
    },

    updateUsualTask(context, task) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        // console.log(task.type);

        if (task.type == 'usual_daily' || task.type == 'usual')
        {
            axios.put(`api/task/${task.task.id}`, {
                task: task            
            })
            .then(() => {
                context.commit('SET_USUAL_TASK', task);
                context.commit('SET_DAILY_TASK', task);
                context.commit('SET_DAILY_TASK_TOMORROW', task);
                context.commit('SET_WEEKLY_TASK', task);
                context.commit('SET_MONTHLY_TASK', task);
            })
            .catch(error => { console.log(error)
            })
            .finally(()=>{
                context.dispatch('getUsualTasks');
                context.dispatch('getWeekTasks');
            })
        } else 
        {
            // console.log(task)
            axios.put(`api/usual-task/${task.task.id}`, {
                task: task            
            })
            .then(() => {
                // console.log(response)
                context.commit('SET_USUAL_TASK', task);
                context.commit('SET_DAILY_TASK', task);
                context.commit('SET_DAILY_TASK_TOMORROW', task);
                context.commit('SET_WEEKLY_TASK', task);
                context.commit('SET_MONTHLY_TASK', task);
            })
            .catch(error => { console.log(error)
            })
            .finally(()=>{
                context.dispatch('getUsualTasks');
                context.dispatch('getWeekTasks');
            })
        }
        
},
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