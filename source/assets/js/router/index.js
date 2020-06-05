import Vue from 'vue';
import VueRouter from 'vue-router';
import DashboardOverview from '../views/DashboardOverview.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/admin', name: 'admin-dashboard-overview', component: DashboardOverview },
  ],
});

export default router;
