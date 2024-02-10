import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// vuetify
import { createVuetify } from 'vuetify';
import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/dist/vuetify.min.css';
// theme
import { customLight, customDark } from './theme';
const vuetify = createVuetify({
  theme: {
    defaultTheme: 'customDark',
    variations: {
      colors: ['primary', 'secondary', 'info', 'accent', 'back'],
      lighten: 5,
      darken: 5,
    },
    themes: {
      customLight,
      customDark,
    },
  },
});
// plugins
import AxiosPlugin from './plugins/axios';
// pinia
import { createPinia } from 'pinia';
const pinia = createPinia();

// components
import pageTitle from '@/components/commons/pageTitle.vue';
import card from '@/components/commons/card.vue';

import text from '@/components/ui/text.vue';
import textarea from '@/components/ui/textarea.vue';

const app = createApp(App);

app.use(vuetify);
app.use(router);
app.use(AxiosPlugin);
app.use(pinia);

app.component('page-title', pageTitle);
app.component('o-card', card);

app.component('o-text', text);
app.component('o-area', textarea);

app.mount('#app');
