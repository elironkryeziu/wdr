<template>
  <div class="">
    <!-- <p>{{ $store.state.workers.workers }}</p> -->
    <div>
        <button @click="createWorker" class="lg:w-1/12 mx-1 rounded-md py-1 my-3 text-sm mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
            Add New
        </button>
    </div>
    <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Initials 
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Number
                    </th>
                    
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="worker in $store.state.workers.workers" :key="worker.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-10 h-10 justify-center p-2 text-sm font-semibold">
                                    {{ worker.initials }} 
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ worker.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-600">
                        {{ worker.number }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button @click="getWorker(worker.id)" class="text-gray-700 hover:text-gray-800">Edit</button>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
import NewWorkerModal from './NewWorkerModal'
import WorkerModal from './WorkerModal'
export default {
    components: {
        NewWorkerModal,
        WorkerModal,
    },
    data() {
        return {

        }
    },
    mounted() {
        if (this.$store.state.workers.workers.length <= 0)
        {
            this.$store.dispatch('getWorkers')
        }
    },
    methods: {
        createWorker() {
            this.$modal.show(NewWorkerModal, {},{ 
                name: "add-worker-modal",
                height: 'auto',
                clickToClose: false,
                draggable: true
            });
        },
        getWorker(id) {
            this.$modal.show(WorkerModal, 
            {
                id: id
            },
            { 
                name: "worker-modal",
                height: 'auto',
                clickToClose: false,
                draggable: true
            });
        }
    }
}
</script>

<style>

</style>