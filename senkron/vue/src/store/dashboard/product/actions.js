import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`product/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.product)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('product').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.products)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('product/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.products)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`product/${payload.id}`, payload.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('product', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`product/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`product/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
