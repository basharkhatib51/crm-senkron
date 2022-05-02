function getUserData() {
  return JSON.parse(localStorage.getItem('userData'))
}

const userAuth = {
  user: getUserData(),

  isUserLoggedIn() {
    return localStorage.getItem('userData') && localStorage.getItem('token')
  },

  getUserRole() {
    return getUserData().role
  },

  getUserPermissions() {
    return getUserData().permissions
  },

  hasAnyPermission(val) {
    return val.some(v => userAuth.getUserPermissions().indexOf(v) >= 0)
  },
  hasPermission(val) {
    if (val) return [val].some(v => userAuth.getUserPermissions().indexOf(v) >= 0)
    return true
  },
  hasAllPermission(val) {
    return val.every(v => userAuth.getUserPermissions().indexOf(v) >= 0)
  },
  hasRole(val) {
    return val === userAuth.getUserRole()
  },
}
export default userAuth
