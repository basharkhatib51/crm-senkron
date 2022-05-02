import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`language/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.language)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('language').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.languages)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('language/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.languages)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`language/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('language', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`language/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`language/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
