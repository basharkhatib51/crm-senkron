import Vue from 'vue'

const actions = {

  GetElements({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('section').then(response => {
        commit('GET_ELEMENTS_DATA', response.data.sections)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`section/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
