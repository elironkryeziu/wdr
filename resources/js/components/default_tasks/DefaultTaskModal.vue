<template>
  <div class="px-4">
      <div class="float-right">
        <button @click="hide" class="py-2">
            <i class="fas fa-times text-gray-700 outline-none text-2xl"></i>
        </button>
      </div>
    <div class="py-6">
        <form @submit.prevent="updateDefaultTask(defaultTaskId)" class="mt-6">
            <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Name</label>
                    <input id="name" type="text" name="name" v-model="$store.state.default_tasks.default_task.name"  class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
                <span class="w-1/2">
                    <label for="sort_order" class="block text-xs font-semibold text-gray-600 uppercase">Sort Order</label>
                    <input id="sort_order" type="number" name="sort_order" v-model="$store.state.default_tasks.default_task.sort_order"  class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                </span>
            </div>
            <div class="">
                <span class="w-1/2">
                  <label for="status" class="block text-xs font-semibold text-gray-600 uppercase">Status</label>
                  <div class="relative">
                      <select v-model="$store.state.default_tasks.default_task.status" name="status" id="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"   
                      >
                          <option>active</option>
                          <option>inactive</option>
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
                    <textarea id="notes" v-model="$store.state.default_tasks.default_task.notes"  name="notes" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>
                    </textarea>
                </span>
            </div>
            <button class="w-1/3 float-right py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                Update
            </button>
        </form>
        <button type="submit" @click="deleteDefaultTask(defaultTaskId)" class="w-1/4 float-right mx-1 py-3 my-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-500 shadow-lg focus:outline-none hover:bg-red-700 hover:shadow-none">
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
          defaultTaskId: this.$props.id,
            // default_task: {
            //     name: '',
            //     sort_order: '',
            //     status: '',
            //     notes: ''
            // }
        }
    },
    mounted() {
      this.getDefaultTask(this.defaultTaskId);
    },
    methods: {
        hide() {
            this.$modal.hide('default-task-modal');
        },
        getDefaultTask(id) {
          if(this.defaultTaskId) {
            this.$store.dispatch('getDefaultTask', { id: this.defaultTaskId })
          }
        },
        updateDefaultTask() {
            this.$store.dispatch('updateDefaultTask', {
                default_task: this.$store.state.default_tasks.default_task
            })
            this.$modal.hide('default-task-modal');
        },
        deleteDefaultTask(id) {
            if(confirm("Do you really want to delete?")){
                this.$store.dispatch('deleteDefaultTask',{
                    id: this.defaultTaskId
                });
                this.$modal.hide('default-task-modal');
            }
        },
    }
}
</script>

<style>

</style>