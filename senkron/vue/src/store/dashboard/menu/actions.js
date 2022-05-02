import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`menu/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.menu)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('menu').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.menus)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('menu/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.menus)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`menu/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('menu', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`menu/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`menu/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
