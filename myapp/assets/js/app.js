import '../css/app.scss';
import Vue from 'vue';
import App from './views/App';
import router from "./vue/routes";

const vueApp = new Vue({
  el: '#app',
  router,
  render: h => h(App),
});

export default vueApp;