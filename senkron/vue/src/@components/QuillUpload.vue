<template>
  <b-container>
    <b-row class="justify-content-center">
      <b-col
        cols="12"
        class="d-flex justify-content-end"
      >
        <b-button
          variant="primary"
          size="sm"
          @click="select_list_status=true"
        >
          {{ $t('Add Media To Editor') }}
        </b-button>
        <b-modal
          v-model="select_list_status"
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
                        :src="item.url?full_path(item.url):null"
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
                              class="UploadImageBorder d-flex UploadImageButton m-auto"
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
                              <font-awesome-icon
                                class="m-auto"
                                :icon="['fas', 'upload']"
                                size="lg"
                              />
                            </div>
                          </transition>
                        </template>
                      </b-media>
                    </b-col>
                    <b-col
                      v-else
                      cols="12"
                    >
                      <div class="m-auto text-center">
                        <div class="py-2">
                          <b-avatar
                            :src="full_path(images.find(e=>e.id===selected_image).url)"
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
                        @click="add_image_to_quill"
                      >
                        {{ $t('Add') }}
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
  name: 'QuillUpload',
  props: {
    value: {
      default: null,
      type: String,
    },
  },
  data() {
    return {
      name: null,
      description: null,
      selected_image: null, // selected_image_id
      selected_image_url: null,
      select_list_status: false,
      errors: [],
      currentPage: 1,
      perPage: 24,
    }
  },
  computed: {
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
    select_list_status(val) {
      this.errors = []
      if (val === true) {
        this.name = null
        this.description = null
        this.selected_image = null
        this.errors = []
        this.currentPage = 1
        this.getImages()
      }
    },
  },
  methods: {
    getImages() {
      this.$store.dispatch('upload/getImages', {
        currentPage: this.currentPage,
        perPage: this.perPage,
      })
    },
    add_image_to_quill() {
      this.$store.dispatch('upload/description', { image_id: this.selected_image, name: this.name, description: this.description }).then(() => {
        if (this.selected_image) this.$emit('input', `${this.value}<br><img src="${this.full_path(this.selected_image_url)}">`)
        this.select_list_status = false
      })
    },
    select_image(item) {
      this.errors = []
      if (this.selected_image !== item.id) {
        this.selected_image = item.id
        this.selected_image_url = item.url
      } else {
        this.selected_image = null
        this.selected_image_url = null
        this.name = null
        this.description = null
      }
    },
    uploadImage(event) {
      console.log(event)
      this.errors = []
      if (event.target.files[0]) {
        this.$store.dispatch('upload/uploadImage', event.target.files[0]).then(response => {
          this.getImages()
          this.selected_image = response.data.image.id
          this.selected_image_url = response.data.image.url
          this.name = null
          this.description = null
        }).catch(error => {
          this.errors = error.response.data.errors.file
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
