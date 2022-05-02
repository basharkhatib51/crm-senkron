const mutations = {
  LOGIN(state, value) {
    state.isUserLoggedIn = true
    localStorage.setItem('token', value.token)
    localStorage.setItem('userData', JSON.stringify(value.user))
    state.userData = value.user
  },
  UPDATE_USER_INFO(state, value) {
    localStorage.setItem('userData', JSON.stringify(value))
    state.userData = value
  },
  LOGOUT(state) {
    state.userData = {}
    state.isUserLoggedIn = false
    state.getUserRole = null
    state.getUserPermissions = []
    localStorage.removeItem('userData')
    localStorage.removeItem('token')
    window.location.reload()
  },
}
export default mutations
