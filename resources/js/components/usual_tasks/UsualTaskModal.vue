<template>
  <div class="">
    <div class="float-right">
        <button @click="hide" class="py-2 px-2">
            <i class="fas fa-times text-gray-700 outline-none text-2xl"></i>
        </button>
    </div>

    <div v-if="taskType === 'daily'">
            <div class="px-2 pt-2">
            <!-- <h1 class="text-xl font-semibold">Hello there 👋, <span class="font-normal">please fill in your information to continue</span></h1> -->
            <form @submit.prevent="updateTask(taskId)" class="mt-6">
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                    <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Task Name</label>
                    <input id="name" type="text" name="name" v-model="$store.state.usual_tasks.daily_task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                    <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                    <div class="relative">
                        <select v-model="$store.state.usual_tasks.daily_task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
                        >
                            <option>K</option>
                            <option>P</option>
                            <option>0</option>
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
                    </span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                        <label for="start" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Start</label>
                        <input id="start" v-model="$store.state.usual_tasks.daily_task.start" type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                        <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                        <input id="finish" v-model="$store.state.usual_tasks.daily_task.finish" type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                </div>
                <label class="float-right block mt-2 text-xs font-semibold text-gray-600 uppercase">
                    Duration: {{ $store.state.usual_tasks.daily_task.start | duration($store.state.usual_tasks.daily_task.finish) }}
                </label>
                <!-- <label for="day" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                <input id="day" v-model="$store.state.usual_tasks.daily_task.date" type="date" name="date" 
                        class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required /> -->
                <div class="py-1 float-right inline-block" v-for="worker in $store.state.usual_tasks.daily_task.workers" :key="worker.id">
                    <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                        {{ worker.initials }} 
                    </p>
                </div>
                <label for="workers" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Workers</label>
                <multiselect
                    v-model="$store.state.usual_tasks.daily_task.workers"
                    :options="$store.state.workers.workers"
                    :multiple="true"
                    :group-select="true"
                    :close-on-select="false"
                    :clear-on-select="false"
                    :preserve-search="true"
                    :showLabels="true"
                    :preselectFirst="false"
                    :allowEmpty="true"
                    :showNoResults="true"
                    placeholder="Choose Workers"
                    label="name"
                    track-by="name"
                    :preselect-first="true"
                    class="block w-full text-gray-700 bg-gray-200 text-sm mb-2"
                    >
            <template slot="selection" slot-scope="{ values, isOpen }">
                <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen">
                    {{ values.length }} options selected
                </span>
            </template>
                <template slot="noResult">
                    No Workers
                </template>      
                </multiselect>
                <button class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Save
                </button>
            </form>
            <button type="submit" @click="deleteTask(taskId)" class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-500 shadow-lg focus:outline-none hover:bg-red-700 hover:shadow-none">
                Delete
            </button>
        </div>
    </div>
    <div v-else-if="taskType === 'weekly'">
        <div class="px-2 pt-2">
            <!-- <h1 class="text-xl font-semibold">Hello there 👋, <span class="font-normal">please fill in your information to continue</span></h1> -->
            <form @submit.prevent="updateTask(taskId)" class="mt-6">
                <div class="">
                    <span class="">
                    <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Task Name</label>
                    <input id="name" type="text" name="name" v-model="$store.state.usual_tasks.weekly_task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <!-- <span class="w-1/2">
                    <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                    <div class="relative">
                        <select v-model="$store.state.usual_tasks.weekly_task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
                        >
                            <option>K</option>
                            <option>P</option>
                            <option>0</option>
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
                    </span> -->
                </div>
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                        <label for="start" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Start</label>
                        <input id="start" v-model="$store.state.usual_tasks.weekly_task.start" type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                        <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                        <input id="finish" v-model="$store.state.usual_tasks.weekly_task.finish" type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                </div>
                <label class="float-right block mt-2 text-xs font-semibold text-gray-600 uppercase">
                    Duration: {{ $store.state.usual_tasks.weekly_task.start | duration($store.state.usual_tasks.weekly_task.finish) }}
                </label>
                <!-- <label for="day" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                <input id="day" v-model="$store.state.usual_tasks.usual_task.date" type="date" name="date" 
                        class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required /> -->
                <div class="pt-6">
                    <div class="py-1 float-right inline-block" v-for="worker in $store.state.usual_tasks.weekly_task.workers" :key="worker.id">
                        <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                            {{ worker.initials }} 
                        </p>
                    </div>
                    <label for="workers" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Workers</label>
                    <multiselect
                        v-model="$store.state.usual_tasks.weekly_task.workers"
                        :options="$store.state.workers.workers"
                        :multiple="true"
                        :group-select="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        :showLabels="true"
                        :preselectFirst="false"
                        :allowEmpty="true"
                        :showNoResults="true"
                        placeholder="Choose Workers"
                        label="name"
                        track-by="name"
                        :preselect-first="true"
                        class="block w-full text-gray-700 bg-gray-200 text-sm mb-2"
                        >
                <template slot="selection" slot-scope="{ values, isOpen }">
                    <span
                    class="multiselect__single"
                    v-if="values.length &amp;&amp; !isOpen">
                        {{ values.length }} options selected
                    </span>
                </template>
                <template slot="noResult">
                    No Workers
                </template>      
                    </multiselect>
                </div>
                <div class="py-2">
                    <div class="py-1 float-right inline-block" v-for="day in $store.state.usual_tasks.weekly_task.days" :key="day.id">
                        <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                            {{ day.name.substring(0,2) }} 
                        </p>
                    </div>
                    <label for="days" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Days</label>
                    <multiselect
                        v-model="$store.state.usual_tasks.weekly_task.days"
                        :options="days"
                        :multiple="true"
                        :group-select="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        :showLabels="true"
                        :preselectFirst="false"
                        :allowEmpty="true"
                        :showNoResults="true"
                        placeholder="Choose Days"
                        label="name"
                        track-by="name"
                        :preselect-first="true"
                        class="block w-full text-gray-700 bg-gray-200 text-sm mb-2"
                        >
                        <template slot="selection" slot-scope="{ values, isOpen }">
                            <span
                            class="multiselect__single"
                            v-if="values.length &amp;&amp; !isOpen">
                                {{ values.length }} options selected
                            </span>
                        </template>
                        <template slot="noResult">
                            No Days
                        </template>      
                    </multiselect>
                </div>

                <button class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Save
                </button>
            </form>
            <button type="submit" @click="deleteTask(taskId)" class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-500 shadow-lg focus:outline-none hover:bg-red-700 hover:shadow-none">
                Delete
            </button>
        </div>
    </div>
    <div v-else-if="taskType === 'monthly'">
        <div class="px-2 pt-2">
            <!-- <h1 class="text-xl font-semibold">Hello there 👋, <span class="font-normal">please fill in your information to continue</span></h1> -->
            <form @submit.prevent="updateTask(taskId)" class="mt-6">
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                    <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Task Name</label>
                    <input id="name" type="text" name="name" v-model="$store.state.usual_tasks.monthly_task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                    <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                    <div class="relative">
                        <select v-model="$store.state.usual_tasks.monthly_task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
                        >
                            <option>K</option>
                            <option>P</option>
                            <option>0</option>
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
                    </span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                        <label for="start" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Start</label>
                        <input id="start" v-model="$store.state.usual_tasks.monthly_task.start" type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                        <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                        <input id="finish" v-model="$store.state.usual_tasks.monthly_task.finish" type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                </div>
                <label class="float-right block mt-2 text-xs font-semibold text-gray-600 uppercase">
                    Duration: {{ $store.state.usual_tasks.monthly_task.start | duration($store.state.usual_tasks.monthly_task.finish) }}
                </label>
                <label for="day" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                <input id="day" v-model="$store.state.usual_tasks.monthly_task.date" type="date" name="date" 
                        class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                <div class="py-1 float-right inline-block" v-for="worker in $store.state.usual_tasks.monthly_task.workers" :key="worker.id">
                    <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                        {{ worker.initials }} 
                    </p>
                </div>
                <label for="workers" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Workers</label>
                <multiselect
                    v-model="$store.state.usual_tasks.monthly_task.workers"
                    :options="$store.state.workers.workers"
                    :multiple="true"
                    :group-select="true"
                    :close-on-select="false"
                    :clear-on-select="false"
                    :preserve-search="true"
                    :showLabels="true"
                    :preselectFirst="false"
                    :allowEmpty="true"
                    :showNoResults="true"
                    placeholder="Choose Workers"
                    label="name"
                    track-by="name"
                    :preselect-first="true"
                    class="block w-full text-gray-700 bg-gray-200 text-sm mb-2"
                    >
            <template slot="selection" slot-scope="{ values, isOpen }">
                <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen">
                    {{ values.length }} options selected
                </span>
            </template>
                <template slot="noResult">
                    No Workers
                </template>      
                </multiselect>
                <button class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Save
                </button>
            </form>
            <button type="submit" @click="deleteTask(taskId)" class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-500 shadow-lg focus:outline-none hover:bg-red-700 hover:shadow-none">
                Delete
            </button>
        </div>
    </div>
    <div v-else>
        <div class="px-2 pt-2">
            <!-- <h1 class="text-xl font-semibold">Hello there 👋, <span class="font-normal">please fill in your information to continue</span></h1> -->
            <form @submit.prevent="updateTask(taskId)" class="mt-6">
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                    <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Task Name</label>
                    <input id="name" type="text" name="name" v-model="$store.state.usual_tasks.usual_task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                    <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                    <div class="relative">
                        <select v-model="$store.state.usual_tasks.usual_task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
                        >
                            <option>K</option>
                            <option>P</option>
                            <option>0</option>
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
                    </span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                        <label for="start" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Start</label>
                        <input id="start" v-model="$store.state.usual_tasks.usual_task.start" type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                        <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                        <input id="finish" v-model="$store.state.usual_tasks.usual_task.finish" type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                </div>
                <label class="float-right block mt-2 text-xs font-semibold text-gray-600 uppercase">
                    Duration: {{ $store.state.usual_tasks.usual_task.start | duration($store.state.usual_tasks.usual_task.finish) }}
                </label>
                <label for="day" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                <input id="day" v-model="$store.state.usual_tasks.usual_task.date" type="date" name="date" 
                        class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                <div class="py-1 float-right inline-block" v-for="worker in $store.state.usual_tasks.usual_task.workers" :key="worker.id">
                    <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                        {{ worker.initials }} 
                    </p>
                </div>
                <label for="workers" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Workers</label>
                <multiselect
                    v-model="$store.state.usual_tasks.usual_task.workers"
                    :options="$store.state.workers.workers"
                    :multiple="true"
                    :group-select="true"
                    :close-on-select="false"
                    :clear-on-select="false"
                    :preserve-search="true"
                    :showLabels="true"
                    :preselectFirst="false"
                    :allowEmpty="true"
                    :showNoResults="true"
                    placeholder="Choose Workers"
                    label="name"
                    track-by="name"
                    :preselect-first="true"
                    class="block w-full text-gray-700 bg-gray-200 text-sm mb-2"
                    >
            <template slot="selection" slot-scope="{ values, isOpen }">
                <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen">
                    {{ values.length }} options selected
                </span>
            </template>
                <template slot="noResult">
                    No Workers
                </template>      
                </multiselect>
                <button class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Save
                </button>
            </form>
            <button type="submit" @click="deleteTask(taskId)" class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-500 shadow-lg focus:outline-none hover:bg-red-700 hover:shadow-none">
                Delete
            </button>
        </div>
    </div>
  </div>
</template>

<script>
import Task from './Task';
import Multiselect from 'vue-multiselect'
import moment from 'moment'

export default {
     components: {
        Task,
        Multiselect
    },
    props: {
        id: Number,
        type: String
    },
    data() {
        return {
            taskId: this.$props.id,
            taskType: this.$props.type,
            value: [],
            days: [
                { id:0, name:'Monday' },
                { id:1, name:'Tuesday' },
                { id:2, name:'Wednesday' },
                { id:3, name:'Thursday' },
                { id:4, name:'Friday' }
            ],
            start: '',
            finish: '',
            diffTime: 0,
        }
    },
    mounted() {
        console.log(this.$props.type)
        this.getTask(this.taskId);

        if (this.$store.state.workers.workers.length <= 0)
        {
            this.$store.dispatch('getWorkers')
        }
    },    
    methods: {
        hide() {
            this.$modal.hide('usual-task-modal');
        },
        getTask(id) {
            this.$store.dispatch('getUsualTask',{
                id: this.taskId,
                type: this.taskType
            })
        },
        updateTask() {
            switch (this.taskType) {
                case 'daily':
                    this.$store.dispatch('updateUsualTask',{
                        type: 'daily',
                        task: this.$store.state.usual_tasks.daily_task
                    })
                    break;
                 case 'weekly':
                    this.$store.dispatch('updateUsualTask',{
                        type: 'weekly',
                        task: this.$store.state.usual_tasks.weekly_task
                    })
                    break;
                     case 'monthly':
                    this.$store.dispatch('updateUsualTask',{
                        type: 'monthly',
                        task: this.$store.state.usual_tasks.monthly_task
                    })
                    break;
                default:
                    this.$store.dispatch('updateUsualTask',{
                        type: 'usual',
                        task: this.$store.state.usual_tasks.usual_task
                    })
                    break;
            }
            this.$modal.hide('usual-task-modal');
            // console.log(this.$store.state.usual_tasks.usual_task);
            
        }
    }
}
</script>

<style>

</style>