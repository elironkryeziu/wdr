<template>
<div>
  <div class="py-4 lg:flex">
    <div class="border lg:w-1/2 w-auto border-gray-300 shadow lg:mx-0 mx-4">
      <p class="text-gray-400 pl-2">Choose workers you want to hide:</p>
      <div class="flex flex-wrap pb-2">
        <div class="pl-2" v-for="worker in $store.state.plan.plan_workers" :key="worker.id">
          <input v-if="!worker.hide" type="checkbox" @change="hideWorker(worker.id)" checked>
          <input v-else type="checkbox" @change="hideWorker(worker.id)">
          <span class="text-gray-400">{{ worker.label }}</span>
        </div>
      </div>
      
    </div>
    <form class="lg:pl-4 lg:mx-0 mx-4 lg:py-0 py-4">
      <label class="text-gray-400">Choose day:</label>
      <vc-date-picker 
            v-model="day" 
            :first-day-of-week="2"
            :masks="{ title: 'MMMM YYYY', L: 'DD-MM-YYYY' }"
            color="gray"
            >
          <template v-slot="{ inputValue, inputEvents }">
            <input
              class="bg-white border border-gray-300 text-gray-500 px-2 py-1 rounded"
              :value="inputValue"
              v-on="inputEvents"
            />
          </template>
      </vc-date-picker>
     <span class="lg:pl-4">
        <button class="py-1 px-4 lg:my-0 my-2 rounded font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
          Search
        </button>
     </span>
    </form>
  </div>
  <div class="py-4">
    <button @click="addUsualTask" class="py-1 px-4 lg:my-0 my-2 rounded font-semibold text-sm tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
      Add Task
    </button>
  </div>
  <vue-cal :selected-date="day.toDateString()"
    :time-from="6 * 60"
    :time-step="30"
    :time-to="18 * 60"
    :disable-views="['years', 'year', 'month']"
    active-view="day"
    hide-weekends
    :twelveHour = "twelveHour"
    :hideTitleBar = "hideTitleBar"
    :events="$store.state.plan.week_tasks"
    :split-days="$store.state.plan.plan_workers"
    :sticky-split-labels="stickySplitLabels"
    :min-cell-width="minCellWidth"
    :min-split-width="minSplitWidth"
    @event-create="createEvent($event)">

    <template class="" v-slot:event="{ event }">
      <div class="px-2">
        <div class="flex justify-between">
          <div class="vuecal__event-title text-gray-600 font-semibold text-left" v-html="event.title" >
          </div>
          <div class="text-sm">
            <button v-if="event.aw_name" @click="openModal(event.task_id,false)">
              <i class="far fa-edit text-gray-600 hover:text-gray-800"></i>
            </button>
            <button v-else @click="openModal(event.task_id,true)">
              <i class="far fa-edit text-gray-600 hover:text-gray-800"></i>
            </button>
            <span>
              <button @click="deleteTask(event.task_id,event.split)">
                <i class="fas fa-times text-gray-600 hover:text-gray-800"></i>
              </button>
            </span>
          </div>
        </div>
        <div class="text-xs text-left">
          <!-- <p class="text-gray-500">{{ event.status }}</p> -->
          <p v-if="event.status == 'P'" class="float-right text-right rounded-full p-2 m-1 bg-yellow-700 text-white  w-5 h-5 flex items-center justify-center text-xs font-bold">
            {{ event.status }} 
          </p>
          <p v-if="event.status == '0'" class="float-right text-right rounded-full p-2 m-1 bg-red-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
            {{ event.status }}
          </p>
          <p v-if="event.status == 'K'" class="float-right text-right rounded-full p-2 m-1 bg-green-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
            {{ event.status }}
          </p>
          <p v-if="event.aw_name" class="text-gray-500">{{ event.aw_name }}</p>
          <p v-if="event.client" class="text-gray-500">CLIENT: {{ event.client }}</p>
          <p v-if="event.coli" class="text-gray-500">COLI: {{ event.coli }} | AW-WM: {{ event.aw_minus_wm }}</p>
          <div class="text-gray-500 pt-2">
            <span>{{ event.start | timeformat }} - {{ event.end | timeformat }}</span>
          </div>
        </div>
      </div>
    </template>
  </vue-cal>
</div>
</template>

<script>
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import axios from 'axios'
import AwTaskModal from '../aw/AwTaskModal.vue';
import UsualTaskModal from '../usual_tasks/UsualTaskModal.vue';
import NewUsualTaskModal from '../usual_tasks/NewUsualTaskModal'

export default {
    components: { VueCal, AwTaskModal, UsualTaskModal,NewUsualTaskModal  },
    data: () => ({
      day: new Date(),
      stickySplitLabels: true,
      hideTitleBar: true,
      twelveHour: true,
      minCellWidth: 400,
      minSplitWidth: 0
}),
created() {

},
mounted() {
  this.$store.dispatch('getPlanWorkers');
  this.$store.dispatch('getWeekTasks');
},
methods: {
    openModal(id,isUsual) {
      if (isUsual)
      {
        this.$modal.show(UsualTaskModal, 
        {
          id: id,
          type: 'usual'
        }, 
        { 
          name: "usual-task-modal",
          height: 'auto',
          clickToClose: false,
          draggable: true
        })
      } else
      {
        this.$modal.show(AwTaskModal, 
          {
            id: id 
          }, 
          { 
            name: "task-modal",
            height: 'auto',
            clickToClose: false,
            draggable: true
          })
      }
    },
    deleteTask(id,worker_id) {
      if(confirm("Do you really want to delete?")){
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + localStorage.getItem("access_token");
    
        axios.post(`api/hide-from-plan/${id}`, {
            worker_id: worker_id
        })
        .then(() => {
            this.$store.dispatch('getWeekTasks');
        })
        this.$modal.hide('task-modal');
        }
    },
    hideWorker(id)
    {
      this.$store.state.plan.plan_workers.map((worker)=>{
        if (worker.id == id)
        {
          worker.hide = !worker.hide
        }
      })
    },
    addUsualTask() {
      this.$modal.show(NewUsualTaskModal, {},{ 
          name: "add-usual-task-modal",
          height: 'auto',
          scrollable: true,
          clickToClose: false,
          draggable: true
      });
    },
  },
  // createEvent(event)
  // {
  //   console.log(event)
  // },
 
}
</script>

<style>

/* You can easily set a different style for each split of your days. */
.vuecal__cell-split.dad {background-color: rgba(221, 238, 255, 0.5);}
.vuecal__cell-split.mom {background-color: rgba(255, 232, 251, 0.5);}
.vuecal__cell-split.kid1 {background-color: rgba(221, 255, 239, 0.5);}
.vuecal__cell-split.kid2 {background-color: rgba(255, 250, 196, 0.5);}
.vuecal__cell-split.kid3 {background-color: rgba(255, 206, 178, 0.5);}
.vuecal__cell-split .split-label {color: rgba(0, 0, 0, 0.1);font-size: 26px;}

/* Different color for different event types. */
.vuecal__event.leisure {background-color: rgba(253, 156, 66, 0.9);border: 1px solid rgb(233, 136, 46);color: #fff;}
.vuecal__event.health {background-color: rgba(164, 230, 210, 0.9);border: 1px solid rgb(144, 210, 190);}
.vuecal__event.sport {background-color: rgba(255, 102, 102, 0.9);border: 1px solid rgb(235, 82, 82);color: #fff;}

</style>