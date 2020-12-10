<template>
<div class="lg:flex md:flex lg:flex-wrap md:flex-wrap">
    <div v-for="aw in $store.state.aw.aws" :key="aw.id" class="lg:w-1/4 md:w-1/2 w-full justify-center font-sans py-4">
      <div class="rounded bg-gray-300 w-64 p-2 shadow-md">
        <div class="flex justify-between py-1">
          <div class="">
            <h3 class="py-1 text-gray-700 font-semibold">{{aw.name }}</h3>
            <p class="text-xs text-gray-500 uppercase">Client: {{ aw.client }}</p>
            <p v-if="aw.tour_number" class="text-xs text-gray-500 uppercase"> {{ aw.tour_number }}</p>
            <p class="text-xs text-gray-500 uppercase">Loading Date: {{ aw.loading_date | moment("DD/MM/YYYY") }}</p>
            <p class="text-xs text-gray-500 uppercase">Coli: {{ aw.coli }}</p>
            <p class="text-xs text-gray-500 uppercase">Led: {{ aw.led }}</p>
            <p class="text-xs text-gray-500 uppercase">Dif: {{ aw.dif }}</p>
            <p class="text-xs text-gray-500 uppercase">Aw - Wm: {{ aw.wmk_not_collection }}</p>
          </div>
        </div>
        <AwTasks :tasks="aw.tasks"/>
        <button @click="addCard(aw.id)" class="mt-3 text-grey-dark">Add a card...</button>
      </div>
    </div>
</div>
</template>

<script>
import AwTasks from './AwTasks'
import AwNewTaskModal from './AwNewTaskModal';

export default {
    components: {
        AwTasks,
        AwNewTaskModal
    },
    data() {
        return {

        }
    },
    mounted() {
        this.$store.dispatch('getAws');
    },
    methods: {
      addCard(id) {
        console.log(id);
        this.$modal.show(AwNewTaskModal, 
          {
            id: id 
          }, 
          { 
            name: "add-task-modal",
            height: 'auto',
            clickToClose: false,
            draggable: true
          })
      }
    }
    
}
</script>

<style>

</style>