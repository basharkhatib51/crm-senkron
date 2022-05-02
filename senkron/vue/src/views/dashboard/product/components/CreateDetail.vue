<template>
  <div>
    <b-row>
      <b-col cols="12">
        <b-tabs>
          <b-tab :title="$t('Create New Detail')">
            <b-card
              :title="$t('Create New Detail')"
            >
              <b-col
                cols="12"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="data.key"
                    class="mt-2"
                    :state="errors ?false:null"
                    :placeholder="$t('Key')"
                  />
                  <small
                    v-if="errors"
                    class="text-danger"
                  >{{ errors }}</small>
                  <label>{{ $t('Key') }}</label>
                </div>
              </b-col>
              <b-col
                cols="12"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="data.value"
                    class="mt-2"
                    :state="errors ?false:null"
                    :placeholder="$t('Value')"
                  />
                  <small
                    v-if="errors"
                    class="text-danger"
                  >{{ errors }}</small>
                  <label>{{ $t('Title') }}</label>
                </div>
              </b-col>
              <b-col cols="12">
                <b-button
                  class="w-100"
                  variant="outline-success"
                  @click="create"
                >
                  {{ $t('Add New Detail') }}
                </b-button>
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
                            v-model="data[`key_${el.code}`]"
                            class="mt-2"
                            :state="errors ?false:null"
                            :placeholder="$t('title')"
                          />
                          <small
                            v-if="errors"
                            class="text-danger"
                          >{{ errors }}</small>
                          <label>{{ $t('Key') }}</label>
                        </div>
                      </b-col>
                      <b-col
                        cols="12"
                      >
                        <div class="form-label-group">
                          <b-form-input
                            v-model="data[`value_${el.code}`]"
                            class="mt-2"
                            :state="errors ?false:null"
                            :placeholder="$t('Value')"
                          />
                          <small
                            v-if="errors"
                            class="text-danger"
                          >{{ errors }}</small>
                          <label>{{ $t('Title') }}</label>
                        </div>
                      </b-col>
                      <b-col cols="12">
                        <b-button
                          class="w-100"
                          variant="outline-success"
                          @click="create"
                        >
                          {{ $t('Add New Detail') }}
                        </b-button>
                      </b-col>
                    </b-row>
                  </b-tab>
                </b-tabs>
              </b-card>
            </b-col>
          </b-tab>
        </b-tabs>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: 'CreateDetail',
  data() {
    return {
      data: {
        key: '',
        value: '',
      },
      errors: '',

    }
  },
  methods: {
    resetData() {
      this.data = {
        key: '',
        value: '',
      }
      this.errors = null
    },
    create() {
      if (!this.data.key && !this.data.value) {
        this.errors = 'the key and value fields are required'
      } else {
        this.$emit('create-detail', this.data)
        this.resetData()
      }
    },
  },
}
</script>
