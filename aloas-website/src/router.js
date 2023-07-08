
import HomePage from './pages/HomePage.vue'
import AboutPage from './pages/AboutPage.vue'
import LoginPopup from './components/LoginPopup.vue'
import ArticlesPage from './pages/ArticlesPage.vue'

export default [
  { path: "/", component: HomePage },
  { path: "/about", component: AboutPage },
  { path: "/events", component: LoginPopup },
  { path: "/articles", component: ArticlesPage},
]
