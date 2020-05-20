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
    props: [
      'user',
    ],
    components: {
      BaseNavbar,
    },
    beforeMount() {
      this.$store.commit('user/setUser', this.$props.user);
    },
  }
</script>

<style scoped>
</style>