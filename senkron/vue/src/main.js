import Vue from 'vue'
import {
  BootstrapVue, IconsPlugin, ToastPlugin, ModalPlugin,
} from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'

import VueI18n from 'vue-i18n'
import router from './router'
import store from './store'
import App from './App.vue'
import mixin from '@/mixin'

import i18n from '@/libs/i18n'

// Global Components
import './global-components'

// Global Variables
import './global-variables'

// Global Functions
import './global-functions'

// 3rd party plugins
import '@/libs/portal-vue'
import '@/libs/toastification'
import '@/libs/sweet-alerts'
import 'vue-toastification/dist/index.css'
import '@core/scss/vue/libs/vue-sweetalert.scss'
import '@core/scss/vue/libs/quill.scss'
import '@core/scss/vue/libs/toastification.scss'
import '@core/scss/vue/libs/vue-select.scss'
import 'aos/dist/aos.css'

// BSV Plugin Registration
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

// VueI18n Plugin Registration
Vue.use(VueI18n)

// Composition API
Vue.use(VueCompositionAPI)

// import core styles
require('@core/scss/core.scss')
// import assets styles
require('@/assets/scss/style.scss')

Vue.config.productionTip = false
if (
  !localStorage.getItem('userData') || localStorage.getItem('userData') === 'undefined' || localStorage.getItem('userData') === undefined || localStorage.getItem('userData') === '[]'
    || localStorage.getItem('userData') === '{}' || localStorage.getItem('userData') === null
    || !localStorage.getItem('token') || localStorage.getItem('token') === 'undefined'
    || localStorage.getItem('token') === undefined || localStorage.getItem('token') === null
) {
  localStorage.removeItem('userData')
  localStorage.removeItem('token')
}
Vue.mixin(mixin)
new Vue({
  router,
  store,
  i18n,
  render: h => h(App),
}).$mount('#app')
