<template>
  <div>
    <div class="form-label-group">
      <b-media class="mb-2">
        <template class="m-auto">
          <transition
            name="fade"
            mode="out-in"
          >
            <div
              :class="!image.id?'UploadImageBorder':''"
              class="d-flex UploadImageButton"
              @click="$refs.refInputEl.click()"
            >
              <input
                ref="refInputEl"
                accept="image/png,image/jpeg"
                type="file"
                name="file"
                class="d-none"
                @change="uploadImage($event)"
              >
              <b-avatar
                v-if="image.id"
                class="m-auto"
                :src="path(image.url)"
                size="100px"
              />
              <font-awesome-icon
                v-else
                class="m-auto"
                :icon="['fas', 'upload']"
                size="lg"
              />
            </div>
          </transition>
        </template>
        <transition
          name="fade"
          mode="out-in"
        >
          <div
            v-if="image.id"
            class="d-flex flex-wrap mt-1"
          >
            <b-button
              variant="outline-danger"
              @click="image = {} , image.id=null,$refs.refInputEl.value=null"
            >
              <span class="d-none d-sm-inline max-w">{{ $t('Remove') }}</span>
            </b-button>
          </div>
        </transition>
      </b-media>
    </div>
    <b-progress
      v-model="size"
      max="100"
      :variant="errors.length>0?'danger':size===100?'success':'warning'"
    />
  </div>
</template>

<script>

export default {
  name: 'SingleUpload',
  props: {
    value: {
      default: null,
      type: Number,
    },
  },
  data() {
    return {
      image: {},
      errors: [],
    }
  },
  computed: {
    size() {
      return this.$store.getters['upload/size']
    },
  },
  watch: {
    value(val) {
      if (val) {
        this.$store.dispatch('upload/getImage', { id: val }).then(response => {
          this.image = response.data.image
        })
      } else this.image = {}
    },
    image(val) {
      if (val.id) this.$emit('input', val.id)
      else {
        this.$emit('input', null)
      }
    },
  },
  created() {
    if (this.value) {
      this.$store.dispatch('upload/getImage', { id: this.value }).then(response => {
        this.image = response.data.image
      })
    } else {
      this.image = {}
    }
  },
  methods: {
    path(val) {
      return this.full_path(val)
    },
    uploadImage(event) {
      this.errors = []
      if (event.target.files[0]) {
        this.$store.dispatch('upload/uploadImage', event.target.files[0]).then(response => {
          this.image = response.data.image
          this.$emit('on-file-error', [])
        }).catch(error => {
          this.errors = error.response.data.errors.file
          this.$emit('on-file-error', error.response.data.errors.file)
        })
      }
    },
  },

}
</script>
<style>
.UploadImageButton {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.UploadImageButton:hover {
    cursor: pointer
}

.UploadImageBorder {
    border: 1px dashed
}
</style>
