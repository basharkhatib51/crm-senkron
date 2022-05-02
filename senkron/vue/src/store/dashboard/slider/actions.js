import Vue from 'vue'

const actions = {
  GetElements({ commit }) {
    Vue.prototype.$http.get('slider').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.sliders)
    })
  },
  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`slider/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.slider)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('slider/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.sliders)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`slider/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('slider', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, element) {
    Vue.prototype.$http.delete(`slider/${element}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`slider/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
