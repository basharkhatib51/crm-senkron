<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card :title="$t('Edit User')">
          <b-row>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="userData.first_name"
                  class="mt-2"
                  :state="errors.first_name ? false:null"
                  :placeholder="$t('First Name')"
                />
                <small
                  v-if="errors.first_name"
                  class="text-danger"
                >{{ errors.first_name[0] }}</small>
                <label>{{ $t('First Name') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="userData.last_name"
                  :state="errors.last_name ? false:null"
                  class="mt-2"
                  :placeholder="$t('Last Name')"
                />
                <small
                  v-if="errors.last_name"
                  class="text-danger"
                >{{ errors.last_name[0] }}</small>
                <label>{{ $t('Last Name') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="userData.user_name"
                  class="mt-2"
                  :state="errors.user_name ? false:null"
                  :placeholder="$t('User Name')"
                />
                <small
                  v-if="errors.user_name"
                  class="text-danger"
                >{{ errors.user_name[0] }}</small>
                <label>{{ $t('User Name') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="userData.email"
                  class="mt-2"
                  :state="errors.email ? false:null"
                  :placeholder="$t('Email')"
                />
                <small
                  v-if="errors.email"
                  class="text-danger"
                >{{ errors.email[0] }}</small>
                <label>{{ $t('Email') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="userData.phone"
                  class="mt-2"
                  :state="errors.phone ? false:null"
                  :placeholder="$t('Phone')"
                  type="number"
                />
                <small
                  v-if="errors.phone"
                  class="text-danger"
                >{{ errors.phone[0] }}</small>
                <label>{{ $t('Phone') }}</label>
              </div>
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
            <b-card :title="$t('User Image')">
              <b-row>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center"
                >
                  <single-upload v-model="userData.avatar_id" />
                </b-col>
              </b-row>
            </b-card>
          </b-col>
          <b-col cols="12">
            <b-card>
              <b-button
                class="w-100"
                variant="gradient-success"
                @click="Edit"
              >
                {{ $t('Confirm') }}
              </b-button>
            </b-card>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </div>
</template>

<script>

import SingleUpload from '@components/SingleUpolad'

export default {
  components: {
    SingleUpload,
  },
  data() {
    return {
      user: '',
      userData: {
        avatar_id: null,
      },
      errors: [],
    }
  },
  computed: {
    User() {
      return this.$store.getters['user/GetElement']
    },
  },
  created() {
    this.getData()
  },
  methods: {
    getData() {
      this.user = this.$route.params.user
      this.$store.dispatch('user/GetElement', this.user).then(() => {
        this.userData = this.User
      })
    },
    Edit() {
      this.$store.dispatch('user/Update', this.userData).then(() => {
        this.errors = []
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
