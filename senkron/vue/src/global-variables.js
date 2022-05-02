import Vue from 'vue'
import store from '@/store'
import axios from '@/libs/axios'
import i18n from '@/libs/i18n'
import auth from '@/libs/auth'

Vue.prototype.$http = axios
Vue.prototype.$trans = i18n
Vue.prototype.$store = store
Vue.prototype.$auth = auth
