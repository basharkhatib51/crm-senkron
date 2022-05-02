import Vue from 'vue'

const FullPath = {
  install() {
    Vue.prototype.full_path = (element = null) => {
      let ImagePath = element
      if (!ImagePath) ImagePath = 'uploads/default/user.png'
      if (window.location.hostname === 'localhost') return `http://localhost:8000/${ImagePath}`
      return `${window.location.origin}/${ImagePath}`
    }
  },
}

const QuillUpload = {
  install() {
    Vue.prototype.quill_upload_axios = async (element = null) => new Promise(resolve => {
      let content = element
      let domain = ''
      if (element) {
        const Avatar = element.split('src="data:').pop().split('">')[0]
        if (Avatar.substring('0', '5') === 'image') {
          Vue.prototype.$http.post('upload/base64', { image: `data:${Avatar}` }).then(response => {
            if (window.location.hostname === 'localhost') { domain = 'http://localhost:8000' }
            content = element.replace(`data:${Avatar}`, domain + response.data.url)
            resolve(content)
          })
        }
      } else {
        resolve(content)
      }
    })
  },
}
Vue.use(QuillUpload)
Vue.use(FullPath)
