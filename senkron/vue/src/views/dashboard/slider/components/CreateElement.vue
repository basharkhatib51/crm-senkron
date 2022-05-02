<template>
  <div>
    <b-row>
      <b-col cols="12">
        <b-tabs>
          <b-tab :title="$t('Create New Element')">
            <b-card
              :title="$t('Create New Element')"
            >
              <b-col
                cols="12"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="data.title"
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
              <b-col cols="12">
                <div>
                  <label>{{ $t('Content Position') }}</label>
                  <v-select
                    v-model="data.content_position"
                    :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                    label="text"
                    :reduce="ContentPositionOptions => ContentPositionOptions.value"
                    :options="ContentPositionOptions"
                  />
                </div>
              </b-col>
              <b-col cols="12">
                <b-form-textarea
                  v-model="data.content"
                  rows="3"
                  class="mt-2"
                  :placeholder="$t('Content')"
                />
              </b-col>
              <b-col
                cols="12"
                class="mt-2"
              >
                <upload
                  v-model="data.image"
                  @update-url="SetImageUrl"
                  @on-file-error="UpdateFileError"
                />
              </b-col>
              <b-col
                cols="12"
                class="mt-2"
              >
                <upload
                  v-model="data.background"
                  @update-url="SetBackgroundUrl"
                  @on-file-error="UpdateFileError"
                />
              </b-col>
            </b-card>
          </b-tab>
          <b-tab :title="$t('Translation')">
            <b-col
              cols="12"
            >
              <b-card
                :title="$t('Multi Language Columns')"
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
                            v-model="data[`title_${el.code}`]"
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
                          v-model="data[`content_${el.code}`]"
                          rows="3"
                          :placeholder="$t('Content')"
                        />
                      </b-col>
                    </b-row>
                  </b-tab>
                </b-tabs>
              </b-card>
            </b-col>
          </b-tab>
        </b-tabs>
      </b-col>
      <b-col cols="12">
        <b-button
          class="w-100"
          variant="outline-success"
          @click="create"
        >
          {{ $t('Add New Element') }}
        </b-button>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: 'CreateElement',
  data() {
    return {
      data: {
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
    ContentPositionOptions() {
      return [
        { value: 'center', text: this.$t('Center') },
        { value: 'start', text: this.$t('Start') },
        { value: 'end', text: this.$t('End') },
      ]
    },
  },
  methods: {
    resetData() {
      this.data = {
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
      this.data.image_url = variable
    },
    SetBackgroundUrl(variable) {
      this.data.background_url = variable
    },
    create() {
      if (!this.data.title) {
        this.errors = 'the title field is required'
      } else {
        this.$emit('create-element', this.data)
        this.resetData()
      }
    },
  },
}
</script>
