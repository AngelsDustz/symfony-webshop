<template>
  <div>
    <base-navbar></base-navbar>
    <router-view></router-view>
  </div>
</template>

<script>
  import BaseNavbar from "../components/BaseNavbar";

  export default {
    name: "App",
    components: {
      BaseNavbar,
    },
  }
</script>

<style scoped>
</style>