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

// libs
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

// components
import pageTitle from '@/components/commons/pageTitle.vue';
import card from '@/components/commons/card.vue';

import text from '@/components/ui/text.vue';
import textarea from '@/components/ui/textarea.vue';
import btnNew from '@/components/ui/btnNew.vue';
import btnCancel from '@/components/ui/btnCancel.vue';
import btnSave from '@/components/ui/btnSave.vue';
import dialog from '@/components/ui/dialog.vue';
import auto from '@/components/ui/auto.vue';
import snackbar from '@/components/ui/snackbar.vue';

// forms
import projectForm from '@/components/projects/projectForm.vue';
import partnerForm from '@/components/partners/partnerForm.vue';

const app = createApp(App);

app.use(vuetify);
app.use(router);
app.use(AxiosPlugin);
app.use(pinia);

app.component('VueDatePicker', VueDatePicker);

app.component('page-title', pageTitle);
app.component('o-card', card);

app.component('o-text', text);
app.component('o-area', textarea);
app.component('o-newbtn', btnNew);
app.component('o-cancelbtn', btnCancel);
app.component('o-savebtn', btnSave);
app.component('o-dialog', dialog);
app.component('o-auto', auto);
app.component('o-snackbar', snackbar);

// forms
app.component('project-form', projectForm);
app.component('partner-form', partnerForm);

app.mount('#app');
