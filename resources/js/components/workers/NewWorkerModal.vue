<template>
  <div class="px-4">
      <div class="float-right">
        <button @click="hide" class="py-2">
            <i class="fas fa-times text-gray-700 outline-none text-2xl"></i>
        </button>
      </div>
    <div class="py-6">
        <form @submit.prevent="createWorker" class="mt-6">
            <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <label for="first_name" class="block text-xs font-semibold text-gray-600 uppercase">First Name</label>
                    <input id="first_name" type="text" name="first_name" v-model="worker.first_name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
                <span class="w-1/2">
                    <label for="last_name" class="block text-xs font-semibold text-gray-600 uppercase">Last Name</label>
                    <input id="last_name" type="text" name="last_name" v-model="worker.last_name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
            </div>
            <div class="">
                <span class="">
                    <label for="number" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Number</label>
                    <input id="number" type="text" v-model="worker.number" name="number" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" />
                </span>
            </div>
            <div class="">
                <span class="">
                    <label for="notes" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Notes</label>
                    <textarea id="notes"  v-model="worker.notes" name="notes" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner">
                    </textarea>
                </span>
            </div>
            <button class="w-1/3 float-right py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                Save
            </button>
        </form>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            worker: {
                first_name: '',
                last_name: '',
                number: '',
                notes: ''
            }
        }
    },
    methods: {
        hide() {
            this.$modal.hide('add-worker-modal');
        },
        createWorker() {
            this.$store.dispatch('createWorker', {
                worker: this.worker
            })
            this.$modal.hide('add-worker-modal');
        }
    }
}
</script>

<style>

</style>