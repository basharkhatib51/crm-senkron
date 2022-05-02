<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-col cols="12">
          <b-card
            :title="$t('Create New Tag')"
          >
            <b-row>
              <b-col
                cols="12"
                md="12"
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
                    @click="create"
                  >
                    {{ $t('Create') }}
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
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {},
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {},
  methods: {
    resetData() {
      this.data = {
      }
      this.errors = []
    },
    create() {
      this.errors = []
      this.$store.dispatch('tag/Create', this.data).then(() => {
        this.data = {
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
