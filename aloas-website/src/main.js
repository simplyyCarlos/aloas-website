
import { createApp } from 'vue'
import App from './App.vue'
import {createRouter, createWebHistory} from 'vue-router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUser, faLock } from '@fortawesome/free-solid-svg-icons'
import routes from './router'

//Logo
import '@fortawesome/fontawesome-free/css/all.css'


const router = createRouter({
    history : createWebHistory(),
    routes
})

library.add(faUser, faLock)

createApp(App)
.use(router)
.component('font-awesome-icon',FontAwesomeIcon)
.mount('#app')




