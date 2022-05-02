<template>
  <b-container>
    <b-row class="justify-content-center">
      <b-col
        cols="auto"
        class="form-label-group"
      >
        <b-media
          v-if="image.id"
          class="mb-2"
        >
          <template class="m-auto">
            <transition
              name="fade"
              mode="out-in"
            >
              <div
                class="d-flex UploadImageButton"
              >
                <b-avatar
                  class="m-auto"
                  :src="path(image.url)"
                  size="100px"
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
                class="m-auto"
                @click="image = {} , image.id=null,$refs.refInputEl.value=null"
              >
                <span class="d-none d-sm-inline max-w">{{ $t('Remove') }}</span>
              </b-button>
            </div>
          </transition>
        </b-media>
      </b-col>

    </b-row>
    <b-row class="justify-content-center">
      <b-col
        cols="auto"
        class="my-1"
      >
        <b-button
          v-if="!image.id"
          variant="primary"
          @click="selectlist=true"
        >
          {{ $t('Choose Image') }}
        </b-button>
        <b-modal
          v-model="selectlist"
          :title="$t('Images List')"
          hide-footer
          size="lg"
        >
          <b-card-text>

            <b-container>
              <b-row>
                <b-col cols="8">
                  <b-row>
                    <b-col
                      v-for="(item,index) in paginated_images"
                      :key="index"
                      cols="auto"
                      class="my-1"
                    >
                      <b-avatar
                        badge
                        badge-top
                        :badge-variant="selected_image===item.id?'success':'#ffffff00'"
                        button
                        size="lg"
                        rounded
                        :src="item.min_url?path(item.min_url):null"
                        @click="select_image(item)"
                      >
                        <template
                          v-if="selected_image===item.id"
                          #badge
                        >
                          <b-icon icon="check" /></template>
                      </b-avatar>
                    </b-col>
                    <b-col
                      cols="12"
                      class="my-1"
                    >
                      <b-pagination
                        v-model="currentPage"
                        align="center"
                        hide-goto-end-buttons
                        :total-rows="rows"
                        :per-page="perPage"
                      />
                      total images :{{ rows }}
                    </b-col>
                  </b-row>
                </b-col>
                <b-col
                  cols="4"
                  class="border-options justify-content-center"
                >

                  {{ $t('options') }}
                  <b-row>
                    <b-col
                      v-if="selected_image===null"
                      cols="12"
                    >
                      <b-media

                        class="mb-2"
                      >
                        <template class="m-auto">
                          <transition
                            name="fade"
                            mode="out-in"
                          >
                            <div
                              :class="!image.id?'UploadImageBorder':''"
                              class="d-flex UploadImageButton m-auto"
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
                    </b-col>
                    <b-col
                      v-else
                      cols="12"
                    >
                      <div class="m-auto text-center">
                        <div class="py-2">
                          <b-avatar
                            :src="path(images.find(e=>e.id===selected_image).url)"
                            size="100px"
                          />
                        </div>
                        <div class="py-2">
                          <div class="form-label-group">
                            <b-form-input
                              v-model="name"
                              :placeholder="$t('Title')"
                            />
                            <label>{{ $t('Title') }}</label>
                          </div>
                        </div>
                        <div class="py-2">
                          <div class="form-label-group">
                            <b-form-textarea
                              v-model="description"
                              rows="3"
                              :placeholder="$t('Description')"
                            />  <label>{{ $t('Description') }}</label>
                          </div>
                        </div>
                      </div>
                    </b-col>

                    <b-col class="mt-2">
                      <b-button
                        class="m-auto w-100"
                        variant="primary"
                        :disabled="!selected_image"
                        @click="choseImage"
                      >
                        {{ $t('Select') }}
                      </b-button>
                    </b-col>
                    <b-col cols="12">
                      <b-alert
                        v-if="errors.length>0"
                        variant="danger"
                        show
                      >
                        <h4 class="alert-heading">
                          {{ $t('Upload Image Error') }}
                        </h4>
                        <div class="alert-body">
                          <span>
                            <ul
                              v-for="(val,index) in errors"
                              :key="index"
                            >
                              <li>{{ val }}</li>
                            </ul>
                          </span>
                        </div>
                      </b-alert>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>
            </b-container>

          </b-card-text>
        </b-modal>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>

export default {
  name: 'Upload',
  props: {
    value: {
      default: null,
      type: Number,
    },
  },
  data() {
    return {
      name: null,
      description: null,
      selected_image: null,
      selectlist: false,
      image: {},
      errors: [],
      currentPage: 1,
      perPage: 24,
    }
  },
  computed: {
    size() {
      return this.$store.getters['upload/size']
    },
    paginated_images() {
      return this.images
    },
    rows() {
      return this.$store.getters['upload/total']
    },
    images() {
      return this.$store.getters['upload/images']
    },
  },
  watch: {
    currentPage() {
      this.selected_image = null
      this.name = null
      this.description = null
      this.getImages()
    },
    selectlist(val) {
      this.errors = []
      this.$emit('on-file-error', [])
      if (val === true) {
        this.name = null
        this.description = null
        this.selected_image = null
        this.errors = []
        this.currentPage = 1
        this.getImages()
      }
    },
    value(val) {
      if (val) {
        this.$store.dispatch('upload/getImage', { id: val }).then(response => {
          this.image = response.data.image
          this.$emit('update-url', this.image.url)
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
    getImages() {
      this.$store.dispatch('upload/getImages', {
        currentPage: this.currentPage,
        perPage: this.perPage,
      })
    },
    path(val) {
      return this.full_path(val)
    },
    choseImage() {
      this.$store.dispatch('upload/description', { image_id: this.selected_image, name: this.name, description: this.description }).then(() => {
        this.image = this.images.find(e => e.id === this.selected_image)
        this.selectlist = false
      })
    },
    select_image(item) {
      this.errors = []
      this.$emit('on-file-error', [])
      if (this.selected_image === item.id) {
        this.selected_image = null
        this.name = null
        this.description = null
      } else {
        this.selected_image = item.id
        this.name = item.name
        this.description = item.description
      }
    },
    uploadImage(event) {
      this.errors = []
      if (event.target.files[0]) {
        this.$store.dispatch('upload/uploadImage', event.target.files[0]).then(response => {
          this.getImages()
          // this.image = response.data.image
          this.selected_image = response.data.image.id
          this.name = null
          this.description = null
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
}.border-options{
    border-left: 3px solid #ffc107;
 }
</style>
