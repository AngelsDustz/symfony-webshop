import Vue from 'vue';
import VueI18n from 'vue-i18n';
import en from './en';

Vue.use(VueI18n);

const translations = new VueI18n({
  locale: 'en',
  fallbackLocale: 'en',
  messages: {
    en,
  },
});

export default translations;