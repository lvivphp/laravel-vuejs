import VueRouter from 'vue-router'
import Vue from 'vue'
import guest from './middleware/guest'
import auth from './middleware/auth'
import store from './store/auth'
import middlewarePipeline from './middleware/middlewarePipeline'

const routes = [
  { path: '/', name: 'DefaultIndex', component: () => import('@/pages/default/Index') },
  { path: '/view/:id', name: 'DefaultView', component: () => import('@/pages/default/View') },

  { path: '/login', name: 'AuthLogin', component: () => import('@/pages/auth/Login'), meta: { middleware: [guest] } },
  { path: '/register', name: 'AuthRegister', component: () => import('@/pages/auth/Register'), meta: { middleware: [guest] } },

  { path: '/post', name: 'PostIndex', component: () => import('@/pages/post/Index'), meta: { middleware: [auth] } },
  { path: '/post/add', name: 'PostAdd', component: () => import('@/pages/post/Add'), meta: { middleware: [auth] } },
  { path: '/post/:id', name: 'PostView', component: () => import('@/pages/post/View'), meta: { middleware: [auth] } },
  { path: '/post/edit/:id', name: 'PostEdit', component: () => import('@/pages/post/Edit'), meta: { middleware: [auth] } },
  { path: '/post/delete/:id', name: 'PostDelete', component: () => import('@/pages/post/Delete'), meta: { middleware: [auth] } },
]

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes
});

router.beforeEach((to, from, next) => {
  if (!to.meta.middleware) {
    return next()
  }
  const middleware = to.meta.middleware
  const context = { to, from, next, store }
  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1)
  })
})
export default router
