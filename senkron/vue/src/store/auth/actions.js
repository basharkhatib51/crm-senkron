import Vue from 'vue'

const actions = {
  hasPermission({ getters }, val) {
    return getters.userData.getUserPermissions.include(val)
  },
  hasAnyPermission({ getters }, val) {
    return val.some(v => getters.userData.getUserPermissions.indexOf(v) >= 0)
  },
  hasAllPermission({ getters }, val) {
    return val.every(v => getters.userData.getUserPermissions.indexOf(v) >= 0)
  },
  hasRole({ getters }, val) {
    return val === getters.userData.getUserRole
  },
  Login({ commit }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/login', payload).then(response => {
        if (response.data.token && response.data.user) {
          commit('LOGIN', response.data)
        }
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Logout({ commit }) {
    if (localStorage.getItem('token')) {
      Vue.prototype.$http.post('authorize/logout').then(() => {
        commit('LOGOUT')
      }).catch(() => {
        commit('LOGOUT')
      })
    } else {
      commit('LOGOUT')
    }
  },

  UpdateAuth({ commit, dispatch }) {
    commit('UPDATE_USER_INFO_STATE', localStorage.getItem('userData'))
    Vue.prototype.$http.post('authorize/get_auth').then(response => {
      commit('UPDATE_USER_INFO', response.data.user)
    }).catch(() => {
      dispatch('Logout')
    })
  },

  ChangePassword({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/change_password', payload).then(response => {
        dispatch('UpdateAuth')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },

  UpdateProfile({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/update_profile', payload).then(response => {
        dispatch('UpdateAuth')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  register(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/register', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ForgetPassword(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/forget_password', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ResetPassword(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/reset_password', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  signup(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/signup', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  CheckCode(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/check_code', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  // SocialLoginAction(_, provider) {
  //   return new Promise((resolve, reject) => {
  //     Vue.prototype.$http.get(`authorize/${provider}/redirect`).then(response => {
  //       resolve(response)
  //     }).catch(error => {
  //       reject(error)
  //     })
  //   })
  // },
  // SocialLoginCallback({ commit }, payload) {
  //   return new Promise((resolve, reject) => {
  //     Vue.prototype.$http.get(`authorize/${payload.provider}/callback`, {
  //       params: {
  //         code: payload.token,
  //       },
  //     }).then(response => {
  //       commit('UPDATE_ACCESS_TOKEN', response.data.token)
  //       commit('UPDATE_USER_INFO', response.data.user)
  //       resolve(response)
  //     }).catch(error => {
  //       reject(error)
  //     })
  //   })
  // },
}
export default actions
