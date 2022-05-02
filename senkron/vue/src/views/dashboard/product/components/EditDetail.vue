<template>
  <div>
    <b-modal
      v-model="isActive"
      :title="$t('EditDetail')"
      :ok-title="$t('Confirm')"
      :cancel-title="$t('Cancel')"
      ok-variant="success"
      no-close-on-backdrop
      @ok="ConfirmEdit"
    >
      <b-row v-if="detail_data">
        <b-col
          cols="12"
        >
          <b-row>
            <b-col
              cols="12"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="detail_data.key"
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
                  v-model="detail_data.value"
                  class="mt-2"
                  :state="errors ?false:null"
                  :placeholder="$t('Value')"
                />
                <small
                  v-if="errors"
                  class="text-danger"
                >{{ errors }}</small>
                <label>{{ $t('Value') }}</label>
              </div>
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
                            v-model="detail_data[`key_${el.code}`]"
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
                            v-model="detail_data[`value_${el.code}`]"
                            class="mt-2"
                            :state="errors ?false:null"
                            :placeholder="$t('Value')"
                          />
                          <small
                            v-if="errors"
                            class="text-danger"
                          >{{ errors }}</small>
                          <label>{{ $t('Value') }}</label>
                        </div>
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
  name: 'EditDetail',
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
      detail_data: {
        key: '',
        value: '',
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
  },
  methods: {
    getData() {
      this.detail_data = { ...this.data }
    },
    resetData() {
      this.detail_data = {
        key: '',
        value: '',
      }
      this.errors = null
    },
    ConfirmEdit() {
      if (!this.detail_data.key && !this.detail_data.value) {
        this.errors = 'the key and value fields are required'
      } else {
        this.$emit('edit-detail', this.detail_data)
        this.resetData()
      }
    },
  },
}
</script>
