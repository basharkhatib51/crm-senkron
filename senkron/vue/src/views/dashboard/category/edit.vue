<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-row>
          <b-col cols="12">
            <b-card
              :title="$t('Edit Category')"
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
                </b-col>
                <b-col
                  md="6"
                  cols="12"
                >
                  <label>{{ $t('Belongs To Category') }}</label>
                  <v-select
                    v-model="data.category_id"
                    :options="Categories"
                    :reduce="Categories => Categories.id"
                    label="name"
                  />
                  <small
                    v-if="errors.parent_category"
                    class="text-danger"
                  >{{ errors.parent_category[0] }}</small>
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
                      md="6"
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
        parent_category: null,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    ElementId() { return this.$route.params.category },
    Element() { return this.$store.getters['category/GetElement'] },
    Categories() { return this.$store.getters['category/GetElements'].filter(e => e.id !== parseInt(this.ElementId, 10)) },
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
        image: null,
        category_id: null,
      }
      this.errors = []
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('category/GetElement', this.$route.params.category).then(() => {
        this.data = this.Element
      })
      this.$store.dispatch('category/GetElements')
    },
    update() {
      this.errors = []
      this.$store.dispatch('category/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
