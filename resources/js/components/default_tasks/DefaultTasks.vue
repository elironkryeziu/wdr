<template>
  <div class="">
    <!-- <p>{{ $store.state.default_tasks.default_tasks }}</p> -->
    <div>
        <button @click="createDefaultTask"  class="lg:w-1/12 w-auto rounded-md mx-1 py-1 my-3 text-sm mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
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
                    <th scope="col" class="px-6 py-3 text-left text-xs flex-wrap font-medium text-gray-500 uppercase tracking-wider">
                        Name 
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sort Order
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Notes
                    </th>
                    
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="default_task in $store.state.default_tasks.default_tasks" :key="default_task.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <p class="text-center mx-1 text-gray-500  w-10 h-10 justify-center p-2 text-sm font-semibold">
                                    {{ default_task.name }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ default_task.sort_order }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-600">
                            {{ default_task.status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-600">
                            {{ default_task.notes }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button @click="getDefaultTask(default_task.id)" class="text-gray-700 hover:text-gray-800">Edit</button>
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
import NewDefaultTaskModal from './NewDefaultTaskModal'
import DefaultTaskModal from './DefaultTaskModal'
export default {
    components: {
        NewDefaultTaskModal,
        DefaultTaskModal,
    },
    data() {
        return {

        }
    },
    mounted() {
       this.getDefaultTasks();
    },
    methods: {
        getDefaultTasks() {
        if (this.$store.state.default_tasks.default_tasks.length <= 0){
                this.$store.dispatch('getDefaultTasks')
            }
        },
        createDefaultTask() {
            this.$modal.show(NewDefaultTaskModal, {},{ 
                name: "add-default-task-modal",
                height: 'auto',
                clickToClose: false,
                draggable: true
            });
        },
        getDefaultTask(id) {
            this.$modal.show(DefaultTaskModal, 
            {
                id: id
            },
            { 
                name: "default-task-modal",
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