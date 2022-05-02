import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store'
import Dashboard from './dashboard'
import Auth from './auth'
import Error from './error'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/',
      name: 'home',
    },
    {
      path: '/acp',
      component: { render: h => h('router-view') },
      meta: {
        thisAuthRequired: 'true',
      },
      children: [
        ...Dashboard,
        ...Auth,
        ...Error,
      ],
    },
    {
      path: '*',
      redirect: 'acp/error-404',
    },
  ],
})
router.beforeEach((to, from, next) => {
  if (to.meta.thisAuthRequired && !store.getters['auth/isUserLoggedIn']) {
    return next({ name: 'login' })
  }
  if (to.matched.some(record => record.meta.authRequired)) {
    if (store.getters['auth/isUserLoggedIn']) {
      if (store.getters['auth/getUserRole'] === 'SuperAdmin') {
        return next()
      }
      if ('meta' in to) {
        if ('anyPermission' in to.meta) if (to.meta.anyPermission.length > 0) if (!Vue.prototype.$auth.hasAnyPermission(to.meta.anyPermission)) return next({ name: 'error-403' })
        if ('permission' in to.meta) if ([to.meta.permission].length > 0) if (!Vue.prototype.$auth.hasAnyPermission([to.meta.permission])) return next({ name: 'error-403' })
        if ('allPermissions' in to.meta) if (to.meta.allPermissions.length > 0) if (!Vue.prototype.$auth.hasAllPermission(to.meta.allPermissions)) return next({ name: 'error-403' })
        if ('role' in to.meta) if (to.meta.role) if (!Vue.prototype.$auth.hasRole(to.meta.role)) return next({ name: 'error-403' })
      }
      return next()
    }
    return next({ name: 'login' })
  }
  return next()
})
router.afterEach(() => {
  // Remove initial loading
  // const appLoading = document.getElementById('loading-bg')
  // if (appLoading) {
  //   appLoading.style.display = 'none'
  // }
})

export default router
