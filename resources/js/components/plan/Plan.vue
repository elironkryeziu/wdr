<template>
<div>
  <vue-cal selected-date="2020-12-14"
          :time-from="6 * 60"
          :time-step="30"
          :time-to="18 * 60"
          :disable-views="['years', 'year', 'month']"
          active-view="day"
          hide-weekends
          editable-events
          :twelveHour = "twelveHour"
          :hideTitleBar = "hideTitleBar"
          :events="week_tasks"
          :split-days="workers"
          :sticky-split-labels="stickySplitLabels"
          :min-cell-width="minCellWidth"
          :min-split-width="minSplitWidth"
          @event-create="createEvent($event)">

          <template class="py-6" v-slot:event="{ event }">
          <div class="vuecal__event-title" v-html="event.title" />
          <p>
          <button @click="openModal(event.task_id)">Edit</button>
          </p>
          <small class="vuecal__event-time">
            <!-- Using Vue Cal injected Date prototypes -->
            <strong>Event start:</strong> <span>{{ event.start.formatTime("h O'clock") }}</span><br/>
            <strong>Event end:</strong> <span>{{ event.end.formatTime("h O'clock") }}</span>
          </small>
        </template>
  </vue-cal>
</div>
</template>

<script>
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import axios from 'axios'
export default {
    components: { VueCal },
    data: () => ({
      stickySplitLabels: true,
      hideTitleBar: true,
      twelveHour: true,
      minCellWidth: 400,
      minSplitWidth: 0,
      workers: [],
      week_tasks: []
}),
created() {
  this.getWorkers()
  this.getTasks()

},
methods: {
  openModal(id)
  {
    console.log(id);
  },
  getWorkers()
  {
    axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.get(`api/plan-workers`)
        .then((response) => {
          this.workers = response.data
        }).catch(error => { console.log(error)
        })
  },
  getTasks()
  {
    axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("access_token");

        axios.get(`api/week-tasks`)
        .then((response) => {
          console.log(response.data)
          this.week_tasks = response.data
        }).catch(error => { console.log(error)
        })

  },
  createEvent(event)
  {
    console.log(event)
  }
}

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