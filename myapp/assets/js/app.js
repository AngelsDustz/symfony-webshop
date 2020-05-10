import '../css/app.scss';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

import router from './router';
import translations from './translations';

import App from './views/App.vue';

Vue.use(BootstrapVue);

const vueApp = new Vue({
  el: '#app',
  router,
  render: (h) => h(App),
  i18n: translations,
});

export default vueApp;
