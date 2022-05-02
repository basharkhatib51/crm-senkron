import Vue from 'vue'

const actions = {
  description(_, payload) {
    Vue.prototype.$http.post(`upload/description/${payload.image_id}`, payload)
  },
  uploadImage({ commit }, payload) {
    return new Promise((resolve, reject) => {
      const data = new FormData()
      data.append('name', 'image')
      data.append('file', payload)

      Vue.prototype.$http.post('upload/image', data, {
        onUploadProgress(progressEvent) {
          commit('UPDATE_UPLOADED_SIZE', parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100), 0))
        },
        headers: {
          'Content-Type': 'image/png',
        },
      }).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  getImages({ commit }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`upload/images?currentPage=${payload.currentPage}&perPage=${payload.perPage}`)
        .then(response => {
          commit('UPDATE_IMAGES', response.data.images.data)
          commit('UPDATE_IMAGES_PAGINATION', response.data.images.total)
          resolve(response)
        }).catch(error => {
          reject(error)
        })
    })
  },
  getImage(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`upload/image/${payload.id}`)
        .then(response => {
          resolve(response)
        }).catch(error => {
          reject(error)
        })
    })
  },
  resetImage({ commit }, payload) {
    commit('SET_DEFAULT_IMAGE', payload.value)
  },
  uploadMultiImages(_, payload) {
    return new Promise((resolve, reject) => {
      const data = new FormData()
      for (let i = 0; i < payload.length; i += 1) {
        data.append(`file_${i}`, payload[i])
      }
      Vue.prototype.$http.post('upload/images', data, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      }).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
