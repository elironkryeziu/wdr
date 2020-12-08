import axios from 'axios'

const state = {
    workers: []
};

const getters = {
    // getTaskById(state, id) {
    //     return state.aws.find(task => task.id === id)
    // }
}; 

const mutations = {
    SET_WORKERS(state, workers) {
        state.workers = workers;      
    },
    
};

const actions = {
    getWorkers(context) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");
  
        axios.get(`api/workers`).then(response => {
          context.commit('SET_WORKERS', response.data.data)
        })
        .catch(error => { console.log(error) })
    },
};


export default {
    state,
    getters,
    actions,
    mutations
};