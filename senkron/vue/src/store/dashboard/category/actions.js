import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`category/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.category)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('category').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.categories)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('category/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.categories)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`category/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('category', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`category/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`category/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
