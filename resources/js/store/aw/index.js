import axios from 'axios'

const state = {
    aws: [],
    task: {}
};

const getters = {
    // getTaskById(state, id) {
    //     return state.aws.find(task => task.id === id)
    // }
}; 

const mutations = {
    SET_AWS(state, aws) {
        state.aws = aws;      
    },
    SET_TASK(state, task) {
        state.task = task;      
    },
};

const actions = {
    getAws(context) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");
  
        axios.get(`api/aws`).then(response => {
          context.commit('SET_AWS', response.data.data)
        })
        .catch(error => { console.log(error) })
    },
    getTask(context,{id}){
        // console.log(id)
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.get(`api/task/${id}`).then(response => {
            // console.log(response);
            context.commit('SET_TASK', response.data.data)
        })
        .catch(error => { console.log(error) })
    },
    updateTask(context, task) {
        // console.log(task.task.id);
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.put(`api/task/${task.task.id}`, {
            task: task            
        }).then(() => {
            context.commit('SET_TASK', task);
        }).catch(error => { console.log(error)
        }).finally(()=>{
            context.dispatch('getAws');
        })

    },
    createTask(context, task) {
        console.log("check");
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.post(`api/tasks`, {
            task: task            
        }).then(() => {
            context.commit('SET_TASK', task);
        }).catch(error => { console.log(error)
        }).finally(()=>{
            context.dispatch('getAws');
        })
    },
    deleteTask(context, {id}) {
        // console.log(id);
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.delete(`api/task/${id}`).then(() => {
            // context.commit('SET_TASK', task);
        }).catch(error => { console.log(error)
        }).finally(()=>{
            context.dispatch('getAws');
        })

    },
};


export default {
    state,
    getters,
    actions,
    mutations
};