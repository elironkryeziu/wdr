<template>
  <div>
      <Navbar />
      <router-view></router-view>
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