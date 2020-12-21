<template>
  <div class="">
        <div class="float-right">
            <button @click="hide" class="py-2 px-2">
                <i class="fas fa-times text-gray-700 outline-none text-2xl"></i>
            </button>
        </div>
        <div class="px-2 py-2">
            <label for="task" class="block text-xs font-semibold text-gray-600 uppercase">Choose Task?</label>
            <div class="relative">
                <select v-model="type" name="task" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
                >
                    <option v-for="type in types" :key="type.id" :value="type.id">{{ type.name }}</option>
                </select>
                <div
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                >
                    <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    >
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="px-2 py-2">
            <div v-if="type == 0">
                <p></p>
            </div>
            <div v-else-if="type == 1">
                <Task typeName="usual" />
            </div>
            <div v-else-if="type == 2">
                <DailyTask typeName="daily" />
            </div>
            <div v-else-if="type == 3">
                <WeeklyTask typeName="weekly" />
            </div>
            <div v-else-if="type == 4">
                <MonthlyTask typeName="monthly" />
            </div>
        </div>
  </div>
</template>

<script>
import Tab from './Tab'
import Tabs from './Tabs'

import DailyTask from './DailyTask';
import WeeklyTask from './WeeklyTask';
import MonthlyTask from './MonthlyTask';
import Task from './Task';

export default {
    components: {
        Tab,
        Tabs,
        DailyTask,
        WeeklyTask,
        MonthlyTask,
        Task
    },
    data() {
        return {
            types: [
                {
                    id: 0,
                    name: ""
                },
                {
                    id: 1,
                    name: "Usual task"
                },
                {
                    id: 2,
                    name: "Daily task"
                },
                {
                    id: 3,
                    name: "Weekly task"
                },
                {
                    id: 4,
                    name: "Monthly task"
                },
            ],
            type: 0,

            
        }
    },
    
    methods: {
        hide() {
            this.$modal.hide('add-usual-task-modal');
        },
        
    }
}
</script>

<style>

</style>