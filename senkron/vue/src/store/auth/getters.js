const getters = {
  userData: state => state.userData,
  isUserLoggedIn: state => state.isUserLoggedIn,
  getUserRole: state => state.userData.role,
  getUserPermissions: state => state.userData.permissions,
}
export default getters
