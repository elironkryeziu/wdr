<template>
<div>
  <div class="py-4 flex ">
    <div class="border w-1/2 border-gray-300 shadow">
      <p class="text-gray-400 pl-2">Choose workers you want to hide:</p>
      <div class="flex flex-wrap">
        <div class="pl-2" v-for="worker in $store.state.plan.plan_workers" :key="worker.id">
          <input type="checkbox" v-model="worker.hide">
          <span class="text-gray-400">{{ worker.label }}</span>
        </div>
         <button @click="checkWorkers" class="w-1/4 text-xs rounded font-semibold float-right mx-1 py-1 my-1 mt-3  text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
            Hide All
          </button>
          <button @click="uncheckWorkers" class="w-1/4 text-xs rounded font-semibold float-right mx-1 py-1 my-1 mt-3  text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-800 hover:shadow-none">
            Unhide All
          </button>
      </div>
    </div>
    <form class="pl-4">
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
     <span  class="pl-4">
        <button class="py-1 px-4 rounded font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
          Search
        </button>
     </span>
    </form>
    <div>
<!-- 
    <button class="py-1 px-4 rounded font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
          Add task
        </button> -->
    </div>
  </div>
  <vue-cal selected-date="2020-12-14"
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
            <button @click="openModal(event.task_id)">
              <i class="far fa-edit text-gray-600 hover:text-gray-800"></i>
            </button>
            <span>
              <button @click="deleteTask(event.task_id)">
                <i class="far fa-trash-alt text-gray-600 hover:text-gray-800"></i>
              </button>
            </span>
          </div>
        </div>
        <!-- <p>
          <button @click="openModal(event.task_id)">Edit</button>
          710/HC/20/AW
          CLIENT: FATLUM GJINOFCI
          LOADING DATE: 14/12/2020
          COLI: 40
          LED: 5
          DIF: 35
          AW - WM: 0
        </p> -->
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
          <p class="text-gray-500">{{ event.aw_name }}</p>
          <p class="text-gray-500">CLIENT: {{ event.client }}</p>
          <p class="text-gray-500">COLI: {{ event.coli }} | AW-WM: {{ event.aw_minus_wm }}</p>
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

export default {
    components: { VueCal, AwTaskModal },
    data: () => ({
      day: new Date(),
      stickySplitLabels: true,
      hideTitleBar: true,
      twelveHour: true,
      minCellWidth: 400,
      minSplitWidth: 0,
      // workers: [],
      // week_tasks: []
}),
created() {

},
mounted() {
  this.$store.dispatch('getPlanWorkers');
  this.$store.dispatch('getWeekTasks');
},
methods: {
  openModal(id) {
    console.log(id);
    // console.log('editing')
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
  },
  deleteTask(id) {
    if(confirm("Do you really want to delete?")){
      this.$store.dispatch('deleteTask',{
        id: id
      });
      this.$modal.hide('task-modal');
      }
    },
    checkWorkers() 
    {
      this.$store.state.plan.plan_workers.map((worker)=>{
        worker.hide = true
      })
    },
    uncheckWorkers() 
    {
      this.$store.state.plan.plan_workers.map((worker)=>{
        worker.hide = false
      })
    }
  },
  createEvent(event)
  {
    console.log(event)
  },
  
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