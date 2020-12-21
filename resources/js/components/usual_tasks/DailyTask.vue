<template>
    <div class="py-6 px-2">
        <p>Daily task</p>
        <form @submit.prevent="createUsualTask" class="mt-6">
            <div class="flex justify-between gap-3">
                <span class="w-full">
                    <label for="first_name" class="block text-xs font-semibold text-gray-600 uppercase">Name</label>
                    <input id="first_name" type="text" name="first_name" v-model="task.name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
            </div>
            <div class="">
                <span class="">
                    <label for="notes" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Notes</label>
                    <textarea id="notes" v-model="task.notes" name="notes" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner">
                    </textarea>
                </span>
            </div>
             <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <label for="start" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Start</label>
                    <input id="start" v-model="task.start" type="time" name="start" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
                <span class="w-1/2">
                    <label for="finish" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Finish</label>
                    <input id="finish" v-model="task.finish"  type="time" name="finish" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
            </div>
            <label v-if="task.start" class="float-right block mt-2 text-xs font-semibold text-gray-600 uppercase">
                Duration: {{ task.start | duration(task.finish) }}
            </label>
            <div class="py-1 float-right inline-block" v-for="worker in task.workers" :key="worker.id">
                <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                    {{ worker.initials }} 
                </p>
            </div>
            <div class="mt-4">
                <label for="workers" class="block mt-4 text-xs font-semibold text-gray-600 uppercase">Workers</label>
                <multiselect
                    v-model="task.workers"
                    :options="$store.state.workers.workers"
                    open-direction="top"
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
                    <span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">
                        {{ values.length }} options selected
                    </span>
                </template>
                <template slot="noResult">
                    No Workers
                </template>      
                </multiselect>
            </div>
            <button class="w-1/3 float-right py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                Save
            </button>
        </form>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import moment from 'vue-moment'

export default {
    props:{
        typeName: String
    },
    components: {
        Multiselect,
    },
    data() {
        return {
            task: {
                name: '',
                notes: '',
                status: '',
                start: '',
                finish: '',
                // date: '',
                workers: []
            },
            type: this.$props.typeName

        }
    },
    
    mounted() {
        if (this.$store.state.workers.workers.length <= 0)
        {
            this.$store.dispatch('getWorkers')
        }
    },
    methods: {
        createUsualTask() {
            this.$store.dispatch('createUsualTask', {
                task: this.task,
                type: this.type
            })
            this.$modal.hide('add-usual-task-modal');
        },
    }
}
</script>

<style>

</style>