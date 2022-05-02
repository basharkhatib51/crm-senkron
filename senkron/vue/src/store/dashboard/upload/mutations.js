const mutations = {
  SET_DEFAULT_IMAGE(state, image) {
    state.image = image
  },
  UPDATE_UPLOADED_SIZE(state, size) {
    state.size = size
  },
  UPDATE_IMAGES(state, images) {
    state.images = images
  },
  UPDATE_IMAGES_PAGINATION(state, total) {
    state.total = total
  },
}
export default mutations
