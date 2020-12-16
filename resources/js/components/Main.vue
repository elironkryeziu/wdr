<template>
 <div class="container mx-auto">
   <div class="py-12 lg:flex lg:px-0 px-12">
     <form @submit.prevent="searchAw">
       <span class="pr-4 block lg:inline lg:py-0 py-2">
        <label class="uppercase text-gray-400">From:</label>
        <vc-date-picker 
            v-model="from" 
            :first-day-of-week="2"
            :masks="{ title: 'MMMM YYYY', L: 'DD-MM-YYYY' }"
            color="gray"
            >
          <template v-slot="{ inputValue, inputEvents }">
            <input
              class="bg-white border border-gray-300 text-gray-500 lg:px-2 lg:py-1 rounded mx-auto"
              :value="inputValue"
              v-on="inputEvents"
            />
          </template>
        </vc-date-picker>
       </span>
       <span class="pr-4 block lg:inline lg:py-0 py-2">
        <label class="uppercase text-gray-400">To:</label>
        <vc-date-picker 
            v-model="to" 
            :first-day-of-week="2"
            :masks="{ title: 'MMMM YYYY', L: 'DD-MM-YYYY' }"
            color="gray"
            >
          <template v-slot="{ inputValue, inputEvents }">
            <input
              class="bg-white border border-gray-300 text-gray-500 lg:px-2 lg:py-1 rounded lg:ml-0 ml-6"
              :value="inputValue"
              v-on="inputEvents"
            />
          </template>
        </vc-date-picker>
       </span>
       <div class="lg:pl-4 block lg:inline">
        <button class="py-1 px-4 rounded font-medium tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
          Search
        </button>
       </div>
     </form>
   </div>
   <Aw />
  </div>
</template>

<script>
import axios from 'axios'

import Aw from '../components/aw/Aw'
export default {
  components: {
    Aw,
  },
  data() {
    return {
      // change to VUEX
      from: new Date(),
      to: new Date(),
    }
  },
  created() {
  },
  methods: {
    searchAw() {
      // console.log(this.from)
      // console.log(this.to)
    }
  }
}
</script>

<style>
    
</style>