import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import appRoutes from './config/app-routes'
import App from './App'

import '../styles/app.css'

const routerHistory = createWebHistory()
const router = createRouter({
  history: routerHistory,
  routes: appRoutes
})

const app = createApp(App)
app.use(router)
app.mount("#app")