<template>
    <div>
        <div class="" >
            <div class="col-md-12 p20">
                <button @click="addUsualTask" class="py-1 px-4 lg:my-0 my-2 rounded font-semibold text-sm tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Add Task
                </button>
            </div>
            <div class="flex">
                <div class="w-1/6 my-4  rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Tasks</p>
                    <ul class="list-group drag p10">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="usual_task in $store.state.usual_tasks.usual_tasks" :key="usual_task.id" @click="getUsualTask(usual_task.id,'usual')">
                            <div class="flex items-center">
                                <span class="text-gray-500 font-semibold">
                                    {{ usual_task.name }}
                                </span>
                                <p v-if="usual_task.status == 'P'" class="float-right text-right rounded-full p-2 m-1 bg-yellow-700 text-white  w-5 h-5 flex items-center justify-center text-xs font-bold">
                                    {{ usual_task.status }}
                                </p>
                                <p v-if="usual_task.status == '0'" class="float-right text-right rounded-full p-2 m-1 bg-red-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ usual_task.status }}
                                </p>
                                <p v-if="usual_task.status == 'K'" class="float-right text-right rounded-full p-2 m-1 bg-green-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ usual_task.status }}
                                </p> 
                            </div>
                            <div>
                                <span class="text-gray-500 text-xs">
                                    {{ usual_task.notes }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-700 text-xs">{{ usual_task.start | timeformat }}</span>-
                                <span class="text-gray-700 text-xs">{{ usual_task.finish | timeformat }}</span>
                            </div>
                            <div class="py-1 worker inline-block" v-for="worker in usual_task.workers" :key="worker.id">
                                <p :data-tooltip="worker.name" class="worker text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                                    {{ worker.initials }} 
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="w-1/6 my-4 rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Daily Tasks for tomorrow</p>
                    <ul class="list-group drag p10">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="daily_task_tomorrow in $store.state.usual_tasks.daily_tasks_tomorrow" :key="daily_task_tomorrow.id" @click="getUsualTask(daily_task_tomorrow.id,'usual_daily')">
                            <div class="flex items-center">
                                <span class="text-gray-500 font-semibold">
                                    {{ daily_task_tomorrow.name }}
                                </span>
                                <p v-if="daily_task_tomorrow.status == 'P'" class="float-right text-right rounded-full p-2 m-1 bg-yellow-700 text-white  w-5 h-5 flex items-center justify-center text-xs font-bold">
                                    {{ daily_task_tomorrow.status }}
                                </p>
                                <p v-if="daily_task_tomorrow.status == '0'" class="float-right text-right rounded-full p-2 m-1 bg-red-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ daily_task_tomorrow.status }}
                                </p>
                                <p v-if="daily_task_tomorrow.status == 'K'" class="float-right text-right rounded-full p-2 m-1 bg-green-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ daily_task_tomorrow.status }}
                                </p> 
                            </div>
                            <div>
                                <span class="text-gray-500 text-xs">
                                    {{ daily_task_tomorrow.notes }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-700 text-xs">{{ daily_task_tomorrow.start | timeformat }}</span>-
                                <span class="text-gray-700 text-xs">{{ daily_task_tomorrow.finish | timeformat }}</span>
                            </div>
                            <div class="py-1 worker inline-block" v-for="worker in daily_task_tomorrow.workers" :key="worker.id">
                                <p :data-tooltip="worker.name" class="worker text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                                    {{ worker.initials }} 
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="w-1/6 my-4 rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Daily tasks</p>
                    <ul class="list-group drag p10">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="daily_task in $store.state.usual_tasks.daily_tasks" :key="daily_task.id" @click="getUsualTask(daily_task.id,daily_task.type)">
                            <div class="flex items-center">
                                <span class="text-gray-500 font-semibold">
                                    {{ daily_task.name }}
                                </span>
                                <p v-if="daily_task.status == 'P'" class="float-right text-right rounded-full p-2 m-1 bg-yellow-700 text-white  w-5 h-5 flex items-center justify-center text-xs font-bold">
                                    {{ daily_task.status }}
                                </p>
                                <p v-if="daily_task.status == '0'" class="float-right text-right rounded-full p-2 m-1 bg-red-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ daily_task.status }}
                                </p>
                                <p v-if="daily_task.status == 'K'" class="float-right text-right rounded-full p-2 m-1 bg-green-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ daily_task.status }}
                                </p>  
                            </div>
                            <div>
                                <span class="text-gray-700 text-xs">{{ daily_task.start | timeformat }}</span>-
                                <span class="text-gray-700 text-xs">{{ daily_task.finish | timeformat }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 text-xs">
                                    {{ daily_task.notes }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="w-1/6 my-4 rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Weekly tasks</p>
                    <ul class="list-group drag p10">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="weekly_task in $store.state.usual_tasks.weekly_tasks" :key="weekly_task.id" @click="getUsualTask(weekly_task.id,weekly_task.type)">
                            <div class="flex items-center">
                                <span class="text-gray-500 font-semibold">
                                    {{ weekly_task.name }}
                                </span>
                                <p v-if="weekly_task.status == 'P'" class="float-right text-right rounded-full p-2 m-1 bg-yellow-700 text-white  w-5 h-5 flex items-center justify-center text-xs font-bold">
                                    {{ weekly_task.status }}
                                </p>
                                <p v-if="weekly_task.status == '0'" class="float-right text-right rounded-full p-2 m-1 bg-red-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ weekly_task.status }}
                                </p>
                                <p v-if="weekly_task.status == 'K'" class="float-right text-right rounded-full p-2 m-1 bg-green-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">
                                    {{ weekly_task.status }}
                                </p>
                            </div>
                            <div>
                                <span class="text-gray-700 text-xs">{{ weekly_task.start | timeformat }}</span>-
                                <span class="text-gray-700 text-xs">{{ weekly_task.finish | timeformat }}</span>
                            </div>
                            <div class="text-xs flex flex-wrap" v-for="day in weekly_task.days" :key="day.id">
                                <p>
                                    {{ day.name }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="w-1/6 my-4 rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Monthly tasks</p>
                    <ul class="list-group drag p10">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="monthly_task in $store.state.usual_tasks.monthly_tasks" :key="monthly_task.id" @click="getUsualTask(monthly_task.id,monthly_task.type)">
                            <p class="text-gray-500 font-semibold">
                                {{ monthly_task.name }}
                            </p>
                            <p class="text-gray-500 text-sm">
                                Day:{{ monthly_task.day_of_month }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NewUsualTaskModal from './NewUsualTaskModal'
import UsualTaskModal from './UsualTaskModal'

export default {
    components: {
        NewUsualTaskModal,
        UsualTaskModal
    },
    data() {
        return {
        
        }
    },
    mounted() {
      this.$store.dispatch('getUsualTasks'); 
    },
    methods: {
        addUsualTask() {
            this.$modal.show(NewUsualTaskModal, {},{ 
                name: "add-usual-task-modal",
                height: 'auto',
                scrollable: true,
                clickToClose: false,
                draggable: true
            });
        },
        getUsualTask(id,type) {
            // console.log(type);
            this.$modal.show(UsualTaskModal, 
            {
                id: id,
                type: type
            },
            { 
                name: "usual-task-modal",
                height: 'auto',
                scrollable: true,
                clickToClose: false,
                draggable: true
            });
        }
    }
}
</script>

<style scoped>
    .p10{
    padding:10px
}
.p20{
  padding:20px
}

.normal {
    background-color: grey;
}

.dragArea{
     min-height: 10px;	
}

.sortable-chosen {
    opacity: 0.7;
    background-color:#dcdcdc;
}
.sortable-ghost {
    background-color:#dcdcdc;
}

.del {
    cursor: pointer;
    color: red;
}
</style>