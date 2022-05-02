// import axios from 'axios'
import Vue from 'vue'

const actions = {
  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`role/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.role)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('role').then(response => {
        commit('GET_ELEMENTS_DATA', response.data.roles)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetPermissions({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('permissions').then(response => {
        commit('GET_PERMISSIONS_DATA', response.data.permissions)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, element) {
    Vue.prototype.$http.delete(`role/${element}`).then(() => {
      dispatch('GetElements')
    })
  },
  Create({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('role', payload).then(response => {
        dispatch('GetElements')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Update({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`role/${payload.id}`, payload).then(response => {
        dispatch('GetElements')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
