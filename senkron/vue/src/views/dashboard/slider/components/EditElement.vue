<template>
  <div>
    <b-modal
      v-model="isActive"
      :title="$t('EditElement')"
      :ok-title="$t('Confirm')"
      :cancel-title="$t('Cancel')"
      ok-variant="success"
      no-close-on-backdrop
      @ok="ConfirmEdit"
    >
      <b-row v-if="Element_data">
        <b-col
          cols="12"
        >
          <b-row>
            <b-col
              cols="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="Element_data.title"
                  class="mt-2"
                  :state="errors ?false:null"
                  :placeholder="$t('title')"
                />
                <small
                  v-if="errors"
                  class="text-danger"
                >{{ errors }}</small>
                <label>{{ $t('Title') }}</label>
              </div>
            </b-col>
            <b-col cols="6">
              <div>
                <label>{{ $t('Content Position') }}</label>
                <v-select
                  v-model="Element_data.content_position"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="text"
                  :reduce="ContentPositionOptions => ContentPositionOptions.value"
                  :options="ContentPositionOptions"
                />
              </div>
            </b-col>
            <b-col cols="12">
              <b-form-textarea
                v-model="Element_data.content"
                rows="3"
                :placeholder="$t('Content')"
              />
            </b-col>
            <b-col
              cols="12"
              class="mt-2"
            >
              <upload
                v-model="Element_data.image"
                @update-url="SetImageUrl"
                @on-file-error="UpdateFileError"
              />
            </b-col>
            <b-col
              cols="12"
              class="mt-2"
            >
              <upload
                v-model="Element_data.background"
                @update-url="SetBackgroundUrl"
                @on-file-error="UpdateFileError"
              />
            </b-col>
            <b-col
              class="mt-5"
              cols="12"
            >
              <b-card
                :title="$t('Multi Language Columns')"
                border-variant="primary"
              >
                <b-tabs>
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
                      >
                        <div class="form-label-group">
                          <b-form-input
                            v-model="Element_data[`title_${el.code}`]"
                            class="mt-2"
                            :state="errors ?false:null"
                            :placeholder="$t('Title')"
                          />
                          <small
                            v-if="errors"
                            class="text-danger"
                          >{{ errors }}</small>
                          <label>{{ $t('Title') }}</label>
                        </div>
                      </b-col>
                      <b-col cols="12">
                        <b-form-textarea
                          v-model="Element_data[`content_${el.code}`]"
                          rows="3"
                          :placeholder="$t('Content')"
                        />
                      </b-col>
                    </b-row>
                  </b-tab>
                </b-tabs>
              </b-card>
            </b-col>
          </b-row>
        </b-col>
      </b-row>

    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'EditElement',
  props: {
    value: {
      default: null,
      type: Boolean,
    },
    data: {
      default: null,
      type: Object,
    },
  },
  data() {
    return {
      Element_data: {
        title: '',
        content: '',
        content_position: '',
        image: null,
        image_url: null,
        background: null,
        background_url: null,
      },
      errors: '',
      fileErrors: '',

    }
  },
  computed: {
    isActive: {
      get() {
        this.getData()
        return this.value
      },
      set(val) {
        this.$emit('input', val)
      },
    },
    ContentPositionOptions() {
      return [
        { value: 'center', text: this.$t('Center') },
        { value: 'start', text: this.$t('Start') },
        { value: 'end', text: this.$t('End') },
      ]
    },
  },
  methods: {
    getData() {
      this.Element_data = { ...this.data }
    },
    resetData() {
      this.Element_data = {
        title: '',
        content: '',
        content_position: '',
        image: null,
        background: null,
      }
      this.errors = null
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    SetImageUrl(variable) {
      this.Element_data.image_url = variable
    },
    SetBackgroundUrl(variable) {
      this.Element_data.background_url = variable
    },
    ConfirmEdit() {
      if (!this.Element_data.title) {
        this.errors = 'the title field is required'
      } else {
        this.$emit('edit-element', this.Element_data)
        this.resetData()
      }
    },
  },
}
</script>
