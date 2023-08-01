
import HomePage from './pages/HomePage.vue'
import AboutPage from './pages/AboutPage.vue'
import ArticlesPage from './pages/ArticlesPage.vue'
import ActivitiesPage from './pages/ActivitiesPage.vue'
import PlanningPage from './pages/PlanningPage.vue'

export default [
  { path: "/", component: HomePage },
  { path : "/planning", component: PlanningPage },
  { path: "/about", component: AboutPage },
  { path: "/articles", component: ArticlesPage},
  { path: "/activities", component: ActivitiesPage},
]
