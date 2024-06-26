
import HomePage from './pages/HomePage.vue'
import AboutPage from './pages/AboutPage.vue'
import EventsPage from './pages/EventsPage.vue'
import LoginPopup from './components/LoginPopup.vue'

export default [
  { path: "/", component: HomePage },
  { path: "/about", component: AboutPage },
  { path: "/events", component: LoginPopup },
]
