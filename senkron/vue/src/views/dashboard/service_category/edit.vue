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
              :title="$t('Edit Service Category')"
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
                    v-model="data.parent_service_category_id"
                    :options="Categories"
                    :reduce="Categories => Categories.id"
                    label="name"
                  />
                  <small
                    v-if="errors.parent_category"
                    class="text-danger"
                  >{{ errors.parent_service_category[0] }}</small>
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
        parent_service_category_id: null,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    ElementId() { return this.$route.params.service_category },
    Element() { return this.$store.getters['serviceCategory/GetElement'] },
    Categories() { return this.$store.getters['serviceCategory/GetElements'].filter(e => e.id !== parseInt(this.ElementId, 10)) },
  },
  created() {
    this.getData()
  },
  methods: {
    resetData() {
      this.data = {
        name: '',
        image: null,
        parent_category: null,
      }
      this.errors = []
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('serviceCategory/GetElement', this.$route.params.service_category).then(() => {
        this.data = this.Element
      })
      this.$store.dispatch('serviceCategory/GetElements')
    },
    update() {
      this.errors = []
      this.$store.dispatch('serviceCategory/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
