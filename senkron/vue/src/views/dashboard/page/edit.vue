<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Edit Page')"
        >
          <b-tabs>
            <b-tab :title="$t('Page Data')">
              <b-row>
                <b-col
                  cols="12"
                  md="12"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="data.title"
                      class="mt-2"
                      :state="errors.title ?false:null"
                      :placeholder="$t('Title')"
                    />
                    <small
                      v-if="errors.title"
                      class="text-danger"
                    >{{ errors.title[0] }}</small>
                    <label>{{ $t('Title') }}</label>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                >
                  <div class="form-label-group">
                    <quill-upload v-model="data.content" />
                    <quill-editor
                      v-if="code_mode===false"
                      v-model="data.content"
                      class="mt-1"
                      :options="editorOption"
                    />
                    <b-form-textarea
                      v-if="code_mode===true"
                      v-model="data.content"
                      class="my-2"
                    />
                    <b-button
                      variant="primary"
                      size="sm"
                      @click="code_mode = !code_mode"
                    >
                      {{ code_mode===false?$t('Code mode'):$t('Editor mode') }}
                    </b-button>
                    <small
                      v-if="errors.content"
                      class="text-danger"
                    >{{ errors.content[0] }}</small>
                    <label>{{ $t('Content') }}</label>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  md="12"
                >
                  <div class="form-label-group">
                    <b-form-textarea
                      v-model="data.excerpt"
                      rows="4"
                      class="mt-2"
                      :placeholder="$t('Excerpt')"
                      :state="errors.excerpt ?false:null"
                    />
                    <small
                      v-if="errors.excerpt"
                      class="text-danger"
                    >{{ errors.excerpt[0] }}</small>
                    <label>{{ $t('Excerpt') }}</label>
                  </div>
                </b-col>

              </b-row>
            </b-tab>
            <b-tab
              v-for="(el,index) in Languages"
              :key="index"
            >
              <template #title>
                <img
                  width="25px"
                  :src="full_path(el.image_url)"
                  class="mr-1"
                >
                <span>{{ el.english_name }}</span>
              </template>
              <b-row>
                <b-col
                  cols="12"
                  md="12"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="data[`title_${el.code}`]"
                      class="mt-2"
                      :state="errors.title ?false:null"
                      :placeholder="$t('Title')"
                    />
                    <small
                      v-if="errors.title"
                      class="text-danger"
                    >{{ errors.title[0] }}</small>
                    <label>{{ $t('Title') }}</label>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                >
                  <div class="form-label-group">
                    <quill-upload v-model="data[`content_${el.code}`]" />
                    <quill-editor
                      v-if="code_mode===false"
                      v-model="data[`content_${el.code}`]"
                      :options="editorOption"
                      class="mt-1"
                    />
                    <b-form-textarea
                      v-if="code_mode===true"
                      v-model="data[`content_${el.code}`]"
                      class="my-2"
                    />
                    <b-button
                      variant="primary"
                      size="sm"
                      @click="code_mode = !code_mode"
                    >
                      {{ code_mode===false?$t('Code mode'):$t('Editor mode') }}
                    </b-button>
                    <small
                      v-if="errors.content"
                      class="text-danger"
                    >{{ errors.content[0] }}</small>
                    <label>{{ $t('Content') }}</label>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  md="12"
                >
                  <div class="form-label-group">
                    <b-form-textarea
                      v-model="data[`excerpt_${el.code}`]"
                      rows="4"
                      class="mt-2"
                      :placeholder="$t('Excerpt')"
                      :state="errors.excerpt ?false:null"
                    />
                    <small
                      v-if="errors.excerpt"
                      class="text-danger"
                    >{{ errors.excerpt[0] }}</small>
                    <label>{{ $t('Excerpt') }}</label>
                  </div>
                </b-col>

              </b-row></b-tab>
          </b-tabs>
        </b-card>
      </b-col>
      <b-col
        cols="12"
        md="4"
      >
        <b-row>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Options')">
              <b-row>
                <b-col
                  cols="12"
                  class="mb-1"
                >
                  <div>
                    <label>{{ $t('Type') }}</label>
                    <v-select
                      v-model="data.type"
                      :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                      label="text"
                      :reduce="TypeOptions => TypeOptions.value"
                      :options="TypeOptions"
                    />
                    <small
                      v-if="errors.layout"
                      class="text-danger"
                    >{{ errors.layout[0] }}</small>
                  </div>
                </b-col>
                <b-col
                  v-if="data.type === 'service'"
                  cols="12"
                  class="mb-1"
                >
                  <div>
                    <label>{{ $t('Service Category') }}</label>
                    <v-select
                      v-model="data.category"
                      :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                      label="name"
                      :reduce="Categories => Categories.id"
                      :options="Categories"
                    />
                    <small
                      v-if="errors.layout"
                      class="text-danger"
                    >{{ errors.layout[0] }}</small>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  class="mb-1"
                >
                  <div>
                    <label>{{ $t('Status') }}</label>
                    <v-select
                      v-model="data.status"
                      :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                      label="text"
                      :reduce="StatusOptions => StatusOptions.value"
                      :options="StatusOptions"
                    />
                    <small
                      v-if="errors.status"
                      class="text-danger"
                    >{{ errors.status[0] }}</small>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                >
                  <div>
                    <label>{{ $t('Layout') }}</label>
                    <v-select
                      v-model="data.layout"
                      :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                      label="text"
                      :reduce="LayoutOptions => LayoutOptions.value"
                      :options="LayoutOptions"
                    />
                    <small
                      v-if="errors.layout"
                      class="text-danger"
                    >{{ errors.layout[0] }}</small>
                  </div>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Tags')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.tags"
                multiple
                :options="Tags"
                :reduce="Tags => Tags.id"
                label="name"
              />
              <small
                v-if="errors.tags"
                class="text-danger"
              >{{ errors.tags[0] }}</small>
            </b-card>
          </b-col>   <b-col
            cols="12"
          >
            <b-card :title="$t('Slider')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.slider_id"
                :options="Sliders"
                :reduce="Sliders => Sliders.id"
                label="name"
              />
              <small
                v-if="errors.slider_id"
                class="text-danger"
              >{{ errors.slider_id[0] }}</small>
            </b-card>
          </b-col>

          <b-col
            cols="12"
            class="justify-content-center"
          >
            <b-card :title="$t('Image')">
              <b-row>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center"
                >
                  <upload
                    v-model="data.image"
                    @on-file-error="UpdateFileError"
                  />
                </b-col>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center mt-2"
                >
                  <small
                    v-if="errors.image"
                    class="text-danger"
                  >{{ errors.image[0] }}</small>
                </b-col>
                <b-col cols="12">
                  <b-alert
                    v-if="fileErrors.length>0"
                    variant="danger"
                    show
                  >
                    <h4 class="alert-heading">
                      {{ $t('Upload Image Error') }}
                    </h4>
                    <div class="alert-body">
                      <span>
                        <ul
                          v-for="(val,index) in fileErrors"
                          :key="index"
                        >
                          <li>{{ val }}</li>
                        </ul>
                      </span>
                    </div>
                  </b-alert>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
          <b-col
            cols="12"
            class="justify-content-center"
          >
            <b-card :title="$t('Background')">
              <b-row>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center"
                >
                  <upload
                    v-model="data.background"
                    @on-file-error="UpdateFileError"
                  />
                </b-col>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center mt-2"
                >
                  <small
                    v-if="errors.background"
                    class="text-danger"
                  >{{ errors.background[0] }}</small>
                </b-col>
                <b-col cols="12">
                  <b-alert
                    v-if="fileErrors.length>0"
                    variant="danger"
                    show
                  >
                    <h4 class="alert-heading">
                      {{ $t('Upload Image Error') }}
                    </h4>
                    <div class="alert-body">
                      <span>
                        <ul
                          v-for="(val,index) in fileErrors"
                          :key="index"
                        >
                          <li>{{ val }}</li>
                        </ul>
                      </span>
                    </div>
                  </b-alert>
                </b-col>
              </b-row>
            </b-card>
          </b-col>

          <b-col cols="12">
            <b-card>
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    class="w-100"
                    variant="gradient-success"
                    @click="update"
                  >
                    {{ $t('Update') }}
                  </b-button>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </b-col>

    </b-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        title: '',
        image: null,
        background: null,
        content: '',
        excerpt: '',
        layout: '',
        status: '',
        slider_id: null,
      },
      errors: [],
      fileErrors: '',
      code_mode: false,
    }
  },
  computed: {
    Categories() {
      return this.$store.getters['serviceCategory/GetElements']
    },
    TypeOptions() {
      return [
        { value: 'normal', text: this.$t('Normal') },
        { value: 'service', text: this.$t('Service') },
      ]
    },
    StatusOptions() {
      return [
        { value: 'published', text: this.$t('published') },
        { value: 'waiting_for_review', text: this.$t('waiting_for_review') },
      ]
    },
    LayoutOptions() {
      return [
        { value: 'without_menu', text: this.$t('without_menu') },
        { value: 'full', text: this.$t('full') },
      ]
    },
    Sliders() { return this.$store.getters['slider/GetElements'] },

    Tags() { return this.$store.getters['tag/GetElements'] },

    Element() { return this.$store.getters['page/GetElement'] },
  },
  created() {
    this.$store.dispatch('slider/GetElements')
    this.$store.dispatch('serviceCategory/GetElements')
    this.$store.dispatch('tag/GetElements')

    this.getData()
  },
  methods: {
    resetData() {
      this.data = {
        title: '',
        title_ar: '',
        title_tr: '',
        image: null,
        background: null,
        content: '',
        content_ar: '',
        content_tr: '',
        excerpt: '',
        excerpt_ar: '',
        excerpt_tr: '',
        layout: '',
        status: '',
      }
      this.errors = []
    },
    setBoolean(val) {
      if (this.data[val] === undefined) { this.data[val] = false }
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('page/GetElement', this.$route.params.page).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('page/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
