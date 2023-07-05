
import { createApp } from 'vue'
import App from './App.vue'
import {createRouter, createWebHistory} from 'vue-router'

// pages
import HomePage from './pages/HomePage.vue'
import AboutPage from './pages/AboutPage.vue'
import EventsPage from './pages/EventsPage.vue'

const router = createRouter({
    history : createWebHistory(),
    routes : [
        {path: "/" , component: HomePage},
        {path: "/about" , component: AboutPage},
        {path: "/events", component: EventsPage},
    ]
})

const app = createApp(App)
app.use(router)
app.mount('#app')



