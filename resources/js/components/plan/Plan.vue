<template>
<div>
  <vue-cal selected-date="2020-12-11"
          :time-from="8 * 60"
          :time-step="30"
          :time-to="17 * 60"
          :disable-views="['years', 'year', 'month']"
          active-view="day"
          editable-events
          hide-weekends
          :twelveHour = "twelveHour"
          :hideTitleBar = "hideTitleBar"
          :dragToCreateEvent = "dragToCreateEvent"
          :events="week_tasks"
          :split-days="workers"
          :sticky-split-labels="stickySplitLabels"
          :min-cell-width="minCellWidth"
          :min-split-width="minSplitWidth">

          <template v-slot:event="{ event }">
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
export default {
    components: { VueCal },
    data: () => ({
      stickySplitLabels: true,
      hideTitleBar: true,
      dragToCreateEvent: false,
      twelveHour: true,
      minCellWidth: 400,
      minSplitWidth: 0,
      workers: [
        { id: 1, label: 'Worker 1' },
        { id: 2, label: 'Worker 2' },
        { id: 3, label: 'Worker 3' },
        { id: 4, label: 'Worker 4' },
        { id: 5, label: 'Worker 5' }
    ],
    week_tasks: [
       {
        "task_id": 3,
        "start": "2020-12-07 10:30",
        "end": "2020-12-07 11:00",
        "title": "Stretching",
        "class": "sport",
        "split": 2
      },
      {
          "task_id": 5,
          "start": "2020-12-09 08:00",
          "end": "2020-12-09 10:00",
          "title": "Collecting",
          "class": "sport",
          "split": 2
      },
      {
          "task_id": 5,
          "start": "2020-12-09 08:00",
          "end": "2020-12-09 10:00",
          "title": "Collecting",
          "class": "health",
          "split": 1
      },
      {
          "task_id": 8,
          "start": "2020-12-09 08:00",
          "end": "2020-12-09 11:00",
          "title": "Preparing documents",
          "class": "sport",
          "split": 2
      },
      {
          "task_id": 1,
          "start": "2020-12-07 08:00",
          "end": "2020-12-07 09:30",
          "title": "Collecting",
          "class": "health",
          "split": 1
      },
      {
          "task_id": 1,
          "start": "2020-12-07 08:00",
          "end": "2020-12-07 09:30",
          "title": "Collecting",
          "class": "sport",
          "split": 2
      }
    ]
}),
methods: {
  openModal(id)
  {
    console.log(id);
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