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
              :title="$t('Edit Menu')"
            >
              <b-row>
                <b-col
                  cols="12"
                  md="6"
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
                      v-if="errors.type"
                      class="text-danger"
                    >{{ errors.type[0] }}</small>
                  </div>
                </b-col>
                <b-col
                  md="6"
                  cols="12"
                >
                  <label>{{ $t('Belongs To Another Element') }}</label>
                  <v-select
                    v-model="data.parent_menu"
                    :options="Menus"
                    :reduce="Menus => Menus.id"
                    label="name"
                  />
                  <small
                    v-if="errors.parent_menu"
                    class="text-danger"
                  >{{ errors.parent_menu[0] }}</small>
                </b-col>
                <b-col
                  md="6"
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
                <b-col
                  v-if="data.type==='page'"
                  cols="12"
                  md="6"
                >
                  <div>
                    <label>{{ $t('Choose Page') }}</label>
                    <v-select
                      v-model="data.url"
                      :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                      label="title"
                      :reduce="Pages => Pages.id"
                      :options="Pages"
                    />
                    <small
                      v-if="errors.type"
                      class="text-danger"
                    >{{ errors.type[0] }}</small>
                  </div>
                </b-col>
                <b-col
                  v-else
                  md="6"
                  cols="12"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="data.url"
                      class="mt-2"
                      :state="errors.url ?false:null"
                      :placeholder="$t('Url')"
                    />
                    <small
                      v-if="errors.url"
                      class="text-danger"
                    >
                      {{ errors.url[0] }}
                    </small>
                    <label>{{ $t('Url') }}</label>
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
        name: '',
        image: null,
        parent_menu: null,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    Pages() {
      return this.$store.getters['page/GetElements']
    },
    TypeOptions() {
      return [
        { value: 'url', text: this.$t('Url') },
        { value: 'page', text: this.$t('Page') },
        { value: 'route', text: this.$t('Route') },
      ]
    },
    ElementId() { return this.$route.params.menu },
    Element() { return this.$store.getters['menu/GetElement'] },
    Menus() { return this.$store.getters['menu/GetElements'].filter(e => e.id !== parseInt(this.ElementId, 10)) },
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
        parent_menu: null,
      }
      this.errors = []
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('page/GetElements')
      this.$store.dispatch('menu/GetElement', this.$route.params.menu).then(() => {
        this.data = this.Element
      })
      this.$store.dispatch('menu/GetElements')
    },
    update() {
      this.errors = []
      this.$store.dispatch('menu/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
