<template>
  <b-navbar toggleable="lg" type="dark" variant="dark">
    <b-navbar-brand href="#">{{ this.$t('adminPanel') }}</b-navbar-brand>

    <b-navbar-toggle target="nar-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item href="#">test</b-nav-item>
      </b-navbar-nav>

      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown :text="this.$store.state.user.username" right>
          <b-dropdown-item href="/admin/logout">Logout</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
  export default {
    name: "BaseNavbar",
  }
</script>

<style scoped>
</style>