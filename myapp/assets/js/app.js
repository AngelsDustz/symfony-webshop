import '../css/app.scss';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

import router from './router';
import translations from './translations';
import store from './store';

import App from './views/App.vue';

Vue.use(BootstrapVue);

// Define root application.
Vue.component('App', App);

const vueApp = new Vue({
  el: '#app',
  router,
  i18n: translations,
  store,
});

export default vueApp;
