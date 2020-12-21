<template>
    <div class="px-4">
        <div class="float-right"> 
            <button @click="hide" class="py-2 px-2">
                <i class="fas fa-times text-gray-700 outline-none text-2xl"></i>
            </button>
        </div>
        <div>
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
            <div class="mt-6">
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                    <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Task Name</label>
                    <input id="name" type="text" name="name" disabled v-model="$store.state.aw.task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                    <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                    <div class="relative">
                        <select disabled v-model="$store.state.aw.task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
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
                        <input id="start" v-model="$store.state.aw.task.start" disabled type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                        <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                        <input id="finish" v-model="$store.state.aw.task.finish" disabled type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                </div>
                <label class="float-right block mt-2 text-xs font-semibold text-gray-600 uppercase">
                    Duration: {{ $store.state.aw.task.start | duration($store.state.aw.task.finish) }}
                </label>
                <label for="day" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                <input disabled id="day" v-model="$store.state.aw.task.date" type="date" name="date" 
                        class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                <div class="py-1  inline-block" v-for="worker in $store.state.aw.task.workers" :key="worker.id">
                    <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                        {{ worker.initials }} 
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: Number,
    },
    data() {
        return {
            taskId: this.$props.id,
        }
    },
    mounted() {
        this.getTask();
    },
    methods: {
        hide() {
            this.$modal.hide('aw-task-plan-modal');
        },
        getTask() {
            this.$store.dispatch('getTask',{
                id: this.taskId
            })
        }
    }
}
</script>

<style>

</style>