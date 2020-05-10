import '../css/app.scss';
import Vue from 'vue';
import App from './components/App';

const vueApp = new Vue({
  el: '#app',
  render: h => h(App),
});