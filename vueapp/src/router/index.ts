import { createRouter, createWebHistory } from 'vue-router'
import messageRoutes from '@/router/message'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [...messageRoutes]
})

export default router
