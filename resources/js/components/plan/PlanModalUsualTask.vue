<template>
    <div class="px-2">
        <div class="float-right"> 
            <button @click="hide" class="py-2 px-2">
                <i class="fas fa-times text-gray-700 outline-none text-2xl"></i>
            </button>
        </div>
            <div class=" pt-6">
            <div class="mt-6">
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                        <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Task Name</label>
                        <input id="name" disabled type="text" name="name" v-model="$store.state.usual_tasks.usual_task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                    <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                    <div class="relative">
                        <select disabled v-model="$store.state.usual_tasks.usual_task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
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
                <div class="">
                    <span class="">
                        <label for="notes" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Notes</label>
                        <textarea disabled id="notes" v-model="$store.state.usual_tasks.usual_task.notes" name="notes" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner">
                        </textarea>
                    </span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="w-1/2">
                        <label for="start" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Start</label>
                        <input id="start" disabled v-model="$store.state.usual_tasks.usual_task.start" type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                    <span class="w-1/2">
                        <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                        <input id="finish" disabled v-model="$store.state.usual_tasks.usual_task.finish" type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                    </span>
                </div>
                <label class="float-right block mt-2 text-xs font-semibold text-gray-600 uppercase">
                    Duration: {{ $store.state.usual_tasks.usual_task.start | duration($store.state.usual_tasks.usual_task.finish) }}
                </label>
                <label for="day" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                <input id="day" disabled v-model="$store.state.usual_tasks.usual_task.date" type="date" name="date" 
                        class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                <div class="py-1 inline-block" v-for="worker in $store.state.usual_tasks.usual_task.workers" :key="worker.id">
                    <label for="workers" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Workers</label>
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
        type: String

    },
    data() {
        return {
            taskId: this.$props.id,
            taskType: this.$props.type,
        }
    },
    mounted() {
        this.getTask();
    },
    methods: {
        hide() {
            this.$modal.hide('aw-usual-task-modal-plan');
        },
        getTask() {
            this.$store.dispatch('getUsualTask',{
                id: this.taskId,
                type: this.taskType
            })
        }
    }
}
</script>

<style>

</style>