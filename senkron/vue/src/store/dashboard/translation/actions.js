import Vue from 'vue'

const actions = {

  GetElements({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('translation').then(response => {
        commit('GET_ELEMENTS_DATA', response.data.translations)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`translation/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
