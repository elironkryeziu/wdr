<template>
  <div class="">
      <Navbar />
      <div class="max-w-7xl mx-auto">
        <router-view></router-view>
      </div>
      <Footer />
  </div>
</template>

<script>
import Navbar from './header/Navbar'
import Footer from './footer/Footer'
export default {
  components: {
    Navbar,
    Footer
  }
}
</script>

<style>

</style>