<template>
  <div>
    <ul class="w-full max-w-md">
        <draggable tag="ul" ghost-class="moving-card" filter=".action-button" class="w-full max-w-md" :list="tasks" :animation="200">
            <li v-for="task in tasks" :key="task.id" @click="show(task.id)"
                class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer">
                <div class="flex items-center">
                    <span v-if="task.name == 'Collecting'">
                    <i class="text-gray-700 fas fa-box-open"></i>
                    </span>
                    <span v-if="task.name == 'Scanning'">
                    <i class="text-gray-700 fas fa-barcode"></i>
                    </span>
                    <span v-if="task.name == 'Stretching'">
                    <i class="text-gray-700 fas fa-dolly-flatbed"></i>
                    </span>
                    <span v-if="task.name == 'Preparing documents'">
                    <i class="text-gray-700 fas fa-file-alt"></i>
                    </span>
                    <p class="ml-2 text-gray-700 font-semibold font-sans tracking-wide">{{ task.name }}</p>
                    <p v-if="task.status == 'P'" class="float-right text-right rounded-full p-2 m-1 bg-yellow-700 text-white  w-5 h-5 flex items-center justify-center text-xs font-bold">{{ task.status }} </p>
                <p v-else class="float-right text-right w-5 text-white font-semibold">{{ task.status }}</p>
                </div>
                <div>
                <span class="text-gray-700 text-xs">{{ task.start }}</span>-
                <span class="text-gray-700 text-xs">{{ task.finish }}</span>
                </div>
                <div>
                <span class="text-gray-700 text-xs">{{ task.date }}</span>
                <br />
                <div class="py-1 inline-block" v-for="worker in task.workers" :key="worker.id">
                    <p class="text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
                    {{ worker.initials }} 
                    </p>
                </div>
                </div>
            </li>
        </draggable>
    </ul>
  </div>
</template>

<script>
import Draggable from 'vuedraggable'
import AwTaskModal from './AwTaskModal'

export default {
    components: {
        Draggable,
        AwTaskModal
    },
    props: {
        tasks: Array
    },
    data() {
        return {

        }
    },
    methods: {
        show(id){
            this.$modal.show(
                AwTaskModal, 
                {
                    id: id 
                }, 
                { 
                    name: "task-modal",
                    height: 'auto',
                    clickToClose: false,
                    draggable: true,
                    focusTrap: true 
                },
                )
        },
        hide() {
            this.$modal.hide("task");
        },
    }
}
</script>

<style>

</style>