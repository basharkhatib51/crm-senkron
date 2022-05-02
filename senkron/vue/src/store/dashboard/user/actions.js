import Vue from 'vue'

const actions = {
  GetElements({ commit }) {
    Vue.prototype.$http.get('user').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.users)
    })
  },
  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`user/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.user)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('user/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.users)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`user/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('user', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, element) {
    Vue.prototype.$http.delete(`user/${element}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`user/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
  ChangePassword({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`user/change_password/${payload.id}`, payload.password).then(response => {
        dispatch('GetElements')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ChangeStatus({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`user/change_status/${payload.id}`, payload).then(response => {
        dispatch('GetElements')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ChangeRole({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`user/change_role/${payload.user}`, payload).then(response => {
        dispatch('GetElements')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
