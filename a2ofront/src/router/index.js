import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: () => import('../components/Dashboard'),
    children: [
      {
        path: '/problem-1',
        name: 'problem-1',
        component: () => import('../views/Problem1.vue')
      },
      {
        path: '/problem-2',
        name: 'problem-2',
        component: () => import('../views/Problem2.vue')
      },
      {
        path: '/problem-3',
        name: 'problem-3',
        component: () => import('../views/Problem3.vue')
      }
    ]
  },
  
]

const router = new VueRouter({
  mode: "history",
  routes
})

export default router
