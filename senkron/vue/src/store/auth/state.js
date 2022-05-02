const state = {
  userData: JSON.parse(localStorage.getItem('userData')),
  isUserLoggedIn: localStorage.getItem('userData') && localStorage.getItem('token'),
}
export default state
