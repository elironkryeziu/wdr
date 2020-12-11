<template>
  <div class="px-4">
      <div class="float-right">
        <button @click="hide" class="py-2">
            <i class="fas fa-times text-gray-700 outline-none text-2xl"></i>
        </button>
      </div>
    <div class="py-6">
        <form @submit.prevent="updateWorker(workerId)" class="mt-6">
            <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <label for="first_name" class="block text-xs font-semibold text-gray-600 uppercase">First Name</label>
                    <input id="first_name" type="text" v-model="$store.state.workers.worker.first_name" name="first_name"  class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
                <span class="w-1/2">
                    <label for="last_name" class="block text-xs font-semibold text-gray-600 uppercase">Last Name</label>
                    <input id="last_name" type="text" name="last_name" v-model="$store.state.workers.worker.last_name"  class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
            </div>
            <div class="">
                <span class="">
                    <label for="number" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Number</label>
                    <input id="number" type="text" v-model="$store.state.workers.worker.number"  name="number" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
            </div>
            <div class="">
                <span class="">
                    <label for="notes" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Notes</label>
                    <textarea id="notes" v-model="$store.state.workers.worker.notes" name="notes" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>
                    </textarea>
                </span>
            </div>
            <button class="w-1/3 float-right py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                update
            </button>
        </form>
        <button type="submit" @click="deleteWorker(workerId)" class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-500 shadow-lg focus:outline-none hover:bg-red-700 hover:shadow-none">
            Delete
        </button>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        id: Number
    },
    data() {
        return {
            workerId: this.$props.id
            // worker: {
            //     first_name: '',
            //     last_name: '',
            //     number: '',
            //     notes: ''
            // }
        }
    },
    mounted() {
        this.getWorker(this.workerId)
    },
    methods: {
        getWorker(id) {
            if(this.workerId) {
                this.$store.dispatch('getWorker', { id: this.workerId })
            }  
        },
        hide() {
            this.$modal.hide('worker-modal');
        },
        updateWorker() {    
            this.$store.dispatch('updateWorker', {
                worker: this.$store.state.workers.worker
            })
            this.$modal.hide('worker-modal');
        },
        deleteWorker(id) {
            if(confirm("Do you really want to delete?")){
                this.$store.dispatch('deleteWorker',{
                    id: this.workerId
                });
                this.$modal.hide('worker-modal');
            }
        },
    }
}
</script>

<style>

</style>