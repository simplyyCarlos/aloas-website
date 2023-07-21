import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faUser, faLock,faXmark } from '@fortawesome/free-solid-svg-icons';
import routes from './router';
import PrimeVue from 'primevue/config';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import 'primevue/resources/themes/lara-light-indigo/theme.css';     
import 'primevue/resources/primevue.min.css';



//Logo
import '@fortawesome/fontawesome-free/css/all.css';

const router = createRouter({
    history: createWebHistory(),
    routes
});

library.add(faUser, faLock, faXmark);

const app = createApp(App);
app.use(router);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');
app.use(PrimeVue);
app.component("Button", Button);
app.component("Dialog", Dialog);
app.component("Textarea", Textarea);
app.component("InputText", InputText);
