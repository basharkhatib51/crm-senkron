<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Edit Language')"
        >
          <b-row>
            <b-col
              cols="12"
              md="6"
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
            </b-col>   <b-col
              md="6"
              cols="12"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="data.english_name"
                  class="mt-2"
                  :state="errors.english_name ?false:null"
                  :placeholder="$t('English Name')"
                />
                <small
                  v-if="errors.english_name"
                  class="text-danger"
                >{{ errors.english_name[0] }}</small>
                <label>{{ $t('English Name') }}</label>
              </div>
            </b-col>
            <b-col
              md="6"
              cols="12"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="data.code"
                  class="mt-2"
                  :state="errors.code ?false:null"
                  :placeholder="$t('Code')"
                />
                <small
                  v-if="errors.code"
                  class="text-danger"
                >{{ errors.code[0] }}</small>
                <label>{{ $t('Code') }}</label>
              </div>
            </b-col>
            <b-col
              md="6"
              cols="12"
            >
              <upload
                v-model="data.image"
                @on-file-error="UpdateFileError"
              />
            </b-col>
          </b-row>
        </b-card>
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
        image: null,
        code: '',
        english_name: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    Element() { return this.$store.getters['language/GetElement'] },
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
        code: '',
        english_name: '',
        image: null,
      }
      this.errors = []
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('language/GetElement', this.$route.params.language).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('language/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
