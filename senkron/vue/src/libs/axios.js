import Vue from 'vue'

// axios
import axios from 'axios'
import router from '@/router'
import store from '../store'

let domain = `${window.location.origin}`
if (window.location.host === 'localhost:8080') domain = 'http://localhost:8000'

let RequestPostCount = 0
let RequestGetCount = 0
const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: `${domain}/api`,
  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
})
axiosIns.defaults.withCredentials = true

Vue.prototype.$http = axiosIns

axiosIns.interceptors.request.use(config => {
  const axiosInsConfig = config
  if (axiosInsConfig.method === 'get') {
    RequestGetCount += 1
    store.dispatch('app/elementLoading', true).then()
  } else {
    RequestPostCount += 1
    store.dispatch('app/fullLoading', true).then()
  }
  axiosInsConfig.headers.common.Accept = `application/json; charset=utf-8; boundary=${Math.random().toString().substr(2)}`
  if (localStorage.getItem('token') && localStorage.getItem('userData')) {
    axiosInsConfig.headers.common.Authorization = `Bearer ${localStorage.getItem('token')}`
  }
  axiosInsConfig.headers.common.LOCAL = Vue.prototype.$trans.locale
  return axiosInsConfig
}, error => Promise.reject(error))

axiosIns.interceptors.response.use(response => {
  if (response.config.method === 'get' && RequestGetCount > 0) {
    RequestGetCount -= 1
  } else if (RequestPostCount > 0) {
    RequestPostCount -= 1
  }
  if (response.data.message) {
    Vue.prototype.$swal({
      icon: 'success',
      title: Vue.prototype.$trans.t('Success'),
      text: Vue.prototype.$trans.t(response.data.message),
      showConfirmButton: false,
      allowOutsideClick: true,
    })
  }
  if (RequestGetCount === 0) store.dispatch('app/elementLoading', false).then()
  if (RequestPostCount === 0) store.dispatch('app/fullLoading', false).then()
  return response
}, error => {
  if (error.response.config.method === 'get' && RequestGetCount > 0) RequestGetCount -= 1
  else if (RequestPostCount > 0) RequestPostCount -= 1
  let MessageError
  if (error.response.data) {
    if (error.response.data.message) MessageError = error.response.data.message
  } else MessageError = Vue.prototype.$trans.t('Unexpected Error')
  const vm = new Vue()
  switch (error.response.status) {
    case 422:
      if (error.response.data.errors.length > 0) {
        vm.$bvToast.toast(Object.values(error.response.data.errors)[0], {
          title: error.response.data.message,
          variant: 'danger',
          solid: false,
        })
      }
      break
    case 401:
      vm.$bvToast.toast('your session time has been expired', {
        title: error.response.data.message,
        variant: 'danger',
        solid: false,
      })
      router.push({
        name: 'login',
      }).then()
      break
    case 404:
      router.push({
        name: 'error-404',
      }).then()
      break
    case 500:
      router.push({
        name: 'error-500',
      }).then()
      break
    case 403:
      router.push({
        name: 'error-403',
      }).then()
      break
    default:
      Vue.prototype.$swal({
        icon: 'error',
        title: Vue.prototype.$trans.t('Error!'),
        text: Vue.prototype.$trans.t(MessageError),
        showConfirmButton: false,
        allowOutsideClick: true,
      })
      break
  }

  if (RequestGetCount === 0) store.dispatch('app/elementLoading', false).then()
  if (RequestPostCount === 0) store.dispatch('app/fullLoading', false).then()
  return Promise.reject(error)
})
export default axiosIns
