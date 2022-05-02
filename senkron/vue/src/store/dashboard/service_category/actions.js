import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`service_category/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.service_category)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('service_category').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.service_categories)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('service_category/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.service_categories)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`service_category/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('service_category', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`service_category/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`service_category/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
