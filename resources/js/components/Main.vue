<template>
 <div class="container my-12 mx-auto">
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
      // users: [
      //   {
      //     id: 1,
      //     name: "Collecting",
      //     user: 'Filan',
      //     avatar: "https://pickaface.net/gallery/avatar/unr_sample_161118_2054_ynlrg.png"
      //   },
      //   {
      //     id: 2,
      //     name: "Scanning",
      //     user: 'Fistek',
      //     avatar: "https://pickaface.net/gallery/avatar/freud51c8b3f65e7dc.png"
      //   },
      //   {
      //     id: 3,
      //     name: "Stretching",
      //     user: 'Milaim',
      //     avatar: "https://pickaface.net/gallery/avatar/Opi51c74d0125fd4.png"
      //   },
      //   {
      //     id: 4,
      //     name: "Preparing documents",
      //     user: 'Milazim',
      //     avatar: "https://pickaface.net/gallery/avatar/unr_yassine_191124_2012_3gngr.png"
      //   },
      // ]
      aws: []
    }
  },
  created() {
    this.getAws();
  },
  methods: {
    getAws() {
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");

      axios.get(`api/aws`).then(response => {
        // console.log(response)
        this.aws = response.data.data;
      })
      .catch(error => { console.log(error) })
    }
  }
}
</script>

<style>
    
</style>