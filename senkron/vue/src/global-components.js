import Vue from 'vue'
import FeatherIcon from '@core/components/feather-icon/FeatherIcon.vue'

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import vSelect from 'vue-select'
import Upload from '@components/Upload.vue'
import QuillUpload from '@components/QuillUpload.vue'
import Builder from '@components/Builder.vue'
import MultiUpload from '@components/MultiUpload.vue'
import { Quill, quillEditor } from 'vue-quill-editor'
import ImageResize from 'quill-image-resize-vue'

Quill.register('modules/imageResize', ImageResize)

Vue.component(quillEditor.name, quillEditor)

library.add(fas)
library.add(fab)
library.add(far)

Vue.component('upload', Upload)
Vue.component('builder', Builder)
Vue.component('quill-upload', QuillUpload)
Vue.component('multi-upload', MultiUpload)
Vue.component('v-select', vSelect)
Vue.component(FeatherIcon.name, FeatherIcon)

Vue.component('font-awesome-icon', FontAwesomeIcon)
