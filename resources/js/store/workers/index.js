import axios from 'axios'

const state = {
    workers: [],
    worker: {}
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
    SET_WORKER(state, worker) {
        state.worker = worker;      
    },
    
};

const actions = {
    getWorker(context, {id}) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.get(`api/worker/${id}`).then(response => {
            // console.log(response);
            context.commit('SET_WORKER', response.data)
        })
        .catch(error => { console.log(error) })
    },

    getWorkers(context) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");
  
        axios.get(`api/workers`).then(response => {
          context.commit('SET_WORKERS', response.data.data)
        })
        .catch(error => { console.log(error) })
    },

    createWorker(context, worker) {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + localStorage.getItem("access_token");
    
        axios.post(`api/workers`, {
            worker: worker
        })
        .then(() => {
            context.commit('SET_WORKER', worker)
        })
        .finally(() => {
            context.dispatch('getWorkers');
        })
        .catch(error => { console.log(error) })
    },

    deleteWorker(context, {id}) {
        // console.log(id);
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.delete(`api/worker/${id}`).then(() => {
            // context.commit('SET_TASK', task);
        })
        .catch(error => { console.log(error)
        })
        .finally(()=>{
            context.dispatch('getWorkers');
        })
    },
    updateWorker(context, worker) {
        // console.log(task.task.id);
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.put(`api/worker/${worker.worker.id}`, {
            worker: worker            
        }).then(() => {
            context.commit('SET_WORKER', worker);
        }).catch(error => { console.log(error)
        }).finally(()=>{
            context.dispatch('getWorkers');
        })

    },
};


export default {
    state,
    getters,
    actions,
    mutations
};