<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-col cols="12">
          <b-row>
            <b-col cols="12">
              <b-card
                :title="$t('Edit Tag')"
              >
                <b-row>
                  <b-col
                    cols="12"
                  >
                    <div class="form-label-group">
                      <b-form-input
                        v-model="data.name"
                        class="mt-2"
                        :state="errors.name ?false:null"
                        :placeholder="$t('Name')"
                      />
                      <small
                        v-if="errors.name"
                        class="text-danger"
                      >{{ errors.name[0] }}</small>
                      <label>{{ $t('Name') }}</label>
                    </div>
                  </b-col>

                </b-row>
              </b-card>
            </b-col>
            <b-col cols="12">
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
                            v-model="data[`name_${el.code}`]"
                            class="mt-2"
                            :state="errors.name ?false:null"
                            :placeholder="$t('Name')"
                          />
                          <small
                            v-if="errors.name"
                            class="text-danger"
                          >{{ errors.name[0] }}</small>
                          <label>{{ $t('Name') }}</label>
                        </div>
                      </b-col>
                    </b-row>
                  </b-tab>
                </b-tabs>
              </b-card>
            </b-col>
          </b-row>
        </b-col>
      </b-col>
      <b-col
        cols="12"
        md="4"
      >
        <b-row>

          <b-col cols="12">
            <b-card>
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    class="w-100 mb-1"
                    variant="gradient-success"
                    @click="update"
                  >
                    {{ $t('Update') }}
                  </b-button>
                  <b-button
                    class="w-100"
                    variant="gradient-danger"
                    @click="resetData"
                  >
                    {{ $t('Reset Form') }}
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
        name: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    Element() { return this.$store.getters['tag/GetElement'] },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.getData()
  },
  methods: {
    resetData() {
      this.data = {
        name: '',
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
      this.$store.dispatch('tag/GetElement', this.$route.params.tag).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('tag/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
