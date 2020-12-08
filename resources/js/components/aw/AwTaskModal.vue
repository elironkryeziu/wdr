<template>
    <div class="px-4">
        <!-- <p>{{ $store.state.aw.task }}</p> -->
            <h3 class="py-1 text-gray-700 font-semibold">{{ $store.state.aw.task.aw }}</h3>
            <p class="text-xs text-gray-500 uppercase">Client: {{ $store.state.aw.task.aw_client }}</p>
            <span v-if="$store.state.aw.task.aw_tour_number" class="text-xs text-gray-500 uppercase"> 
                {{ $store.state.aw.task.aw_tour_number }}
            </span>
            <span class="text-xs text-gray-500 uppercase">Loading Date: {{ $store.state.aw.task.aw_loading_date }} |</span>
            <span class="text-xs text-gray-500 uppercase">Coli: {{ $store.state.aw.task.aw_coli }} |</span>
            <span class="text-xs text-gray-500 uppercase">Led: {{ $store.state.aw.task.aw_led }} |</span>
            <span class="text-xs text-gray-500 uppercase">Dif: {{ $store.state.aw.task.aw_dif }} |</span>
            <span class="text-xs text-gray-500 uppercase">Aw - Wm: {{ $store.state.aw.task.aw_wmk_not_collection }}</span>
        <div>
            <div class="">
                <!-- <h1 class="text-xl font-semibold">Hello there 👋, <span class="font-normal">please fill in your information to continue</span></h1> -->
                <form @submit.prevent="updateTask(taskId)" class="mt-6">
                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                        <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Task Name</label>
                        <input id="name" type="text" name="name" v-model="$store.state.aw.task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        </span>
                        <span class="w-1/2">
                        <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                        <div class="relative">
                            <select v-model="$store.state.aw.task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
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
                            <input id="start" v-model="$store.state.aw.task.start" type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        </span>
                        <span class="w-1/2">
                            <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                            <input id="finish" v-model="$store.state.aw.task.finish" type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        </span>
                    </div>
                    <label for="day" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                    <input id="day" v-model="$store.state.aw.task.date" type="date" name="date" 
                            class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    <label for="workers" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Workers</label>
                    <multiselect
                        v-model="$store.state.aw.task.workers"
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
                    <div class="py-1 inline-block" v-for="worker in $store.state.aw.task.workers" :key="worker.id">
                        <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                            {{ worker.initials }} 
                        </p>
                    </div>
                    <button class="w-1/3 float-right py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    components: {
        Multiselect
    },
    props: {
        id: Number
    },
    data() {
        return {
            taskId: this.$props.id,
            value: []
        }
    },
    
    mounted() {
        this.$store.dispatch('getTask',{
            id: this.taskId
        }),
        this.$store.dispatch('getWorkers')
        console.log(this.$store.state.workers.workers);
    },
    methods: {
        updateTask(id) {
            this.$store.dispatch('updateTask',{
                task: this.$store.state.aw.task
            })
        }
    }
}
</script>

<style scoped>
@import url("https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css");
</style>