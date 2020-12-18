<template>
  <div>
    <ul class="w-full max-w-md">
        <draggable tag="ul" ghost-class="moving-card" filter=".action-button" class="w-full max-w-md" :list="tasks" :animation="200">
            <li v-for="task in tasks" :key="task.id" @click="show(task.id,task.closed)"
                class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                :class="task.status == 'K' ? 'bg-green-100' : ''">
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
                    <p v-if="task.status == '0'" class="float-right text-right rounded-full p-2 m-1 bg-red-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">{{ task.status }}</p>
                    <p v-if="task.status == 'K'" class="float-right text-right rounded-full p-2 m-1 bg-green-700 text-white font-semibold w-5 h-5 flex items-center justify-center text-xs">{{ task.status }}</p>
                </div>
                <div>
                    <span class="text-gray-700 text-xs">{{ task.start | timeformat }}</span>-
                    <span class="text-gray-700 text-xs">{{ task.finish | timeformat }}</span>
                </div>
                <div>
                    <span class="text-gray-700 text-xs">{{ task.date | moment("DD/MM/YYYY") }}</span>
                    <br />
                    <div class="py-1 worker inline-block" v-for="worker in task.workers" :key="worker.id">
                        <p :data-tooltip="worker.name" class="worker text-center mx-1 rounded-full bg-gray-500 text-white  w-5 h-5 justify-center text-xs font-semibold">
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
        show(id,closed){
            if (!closed)
            {
                this.$modal.show(
                    AwTaskModal, 
                    {
                        id: id 
                    }, 
                    { 
                        name: "task-modal",
                        height: 'auto',
                        clickToClose: false,
                        draggable: true
                    },
                    )
            }
        },
        hide() {
            this.$modal.hide("task");
        },
    }
}
</script>

<style scoped>
    .worker {
        position: relative;
    }

    .worker::before,
    .worker::after {
        --scale: 0;

        position: absolute;
        top: -.25rem;
        left: 50%;
        transform: translateX(-50%) translateY(-100%) scale(var(--scale));
        transition: 150ms transform;
        transform-origin: bottom center;
    }

    .worker::before {
        content: attr(data-tooltip);
        color: rgba(55, 65, 81, var(--tw-bg-opacity));
        font-weight: 500;
        padding: .3rem;
        width: auto;
        background: white;
        box-shadow: 0.3em 0.3em 1em rgba(0,0,0,0.3);
        border-radius: .3rem;
        text-align: center;
        z-index: 1;
    }

    .worker:hover::before,
    .worker:hover::after {
        --scale: 1;
    }
</style>