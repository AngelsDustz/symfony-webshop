<template>
  <b-container class="p-0 m-0" fluid="">
    <base-navbar></base-navbar>
    <b-row no-gutters>
      <b-col cols="2">
        <base-sidebar></base-sidebar>
      </b-col>
      <b-col>
        <router-view></router-view>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  import BaseNavbar from "../components/BaseNavbar";
  import BaseSidebar from "../components/BaseSidebar";

  export default {
    name: "App",
    props: [
      'user',
    ],
    components: {
      BaseSidebar,
      BaseNavbar,
    },
    beforeMount() {
      this.$store.commit('user/setUser', this.$props.user);
    },
  }
</script>

<style scoped>
</style>