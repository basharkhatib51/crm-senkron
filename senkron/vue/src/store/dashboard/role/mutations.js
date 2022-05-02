const mutations = {
  GET_ELEMENT_DATA(state, value) {
    state.element = value
  },
  GET_ELEMENTS_DATA(state, value) {
    state.elements = value
  },
  GET_PERMISSIONS_DATA(state, value) {
    state.permissions = value
  },
}
export default mutations
