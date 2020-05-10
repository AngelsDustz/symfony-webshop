import Vue from 'vue';
import VueRouter from "vue-router";
import Dashboard from "../components/Dashboard";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/admin', name: 'index', component: Dashboard}
  ],
});

export default router;