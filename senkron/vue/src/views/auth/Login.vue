<template>
  <div class="app">

    <div class="auth-wrapper auth-v2">
      <b-row class="auth-inner m-0">
        <b-link
          class="brand-logo"
          @click="$router.push({name:'home'})"
        >
          <h2 class="brand-text text-primary ml-1">
            {{ appName }}
          </h2>
        </b-link>
        <b-col
          lg="8"
          class="d-none d-lg-flex align-items-center p-5 overflow-hidden"
        >
          <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
            <auth-image-template />
          </div>
        </b-col>
        <b-col
          lg="4"
          class="d-flex justify-content-center align-items-center auth-bg px-2 p-lg-5"
        >
          <b-row>
            <b-col
              sm="8"
              md="6"
              lg="12"
              class="px-xl-2 mx-auto"
            >
              <b-card-title
                title-tag="h2"
                class="font-weight-bold mb-1"
              >
                {{ $t('Welcome to') }} {{ appName }}! 👋
              </b-card-title>
              <b-card-text class="mb-2">
                {{ $t('Please sign-in to your account and start the adventure') }}
              </b-card-text>
              <b-form
                class="auth-login-form mt-2"
                @submit.prevent
              >
                <!-- email -->
                <div class="form-label-group">
                  <b-form-input
                    v-model="email"
                    class="mt-2"
                    :placeholder="$t('Email')"
                    :state="ValidationErrors.email ?false:null"
                  />
                  <small
                    v-if="ValidationErrors.email"
                    class="text-danger"
                  >
                    {{ ValidationErrors.email[0] }}
                  </small>
                  <label>{{ $t('Email') }}</label>
                </div>
                <div class="form-label-group">
                  <b-form-input
                    v-model="password"
                    class="mt-2"
                    type="password"
                    :placeholder="$t('Password')"
                    :state="ValidationErrors.email?false:null"
                  />
                  <small
                    v-if="ValidationErrors.password"
                    class="text-danger"
                  >
                    {{ ValidationErrors.password[0] }}
                  </small>
                  <label>{{ $t('Password') }}</label>
                </div>
                <b-row>
                  <b-col class="d-flex justify-content-end">
                    <router-link
                      class="text-primary"
                      :to="{name:'forget-password'}"
                    >
                      {{ $t('Forget Password') }}
                    </router-link>
                  </b-col>
                </b-row>
                <b-form-group>
                  <b-form-checkbox
                    id="remember-me"
                    v-model="status"
                    name="checkbox-1"
                  >
                    {{ $t('Remember Me') }}
                  </b-form-checkbox>
                </b-form-group>

                <!-- submit buttons -->
                <b-button
                  type="submit"
                  variant="primary"
                  block
                  @click="Login"
                >
                  {{ $t('Sign in') }}
                </b-button>
              </b-form>
            </b-col>
          </b-row>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import AuthImageTemplate from '@/views/auth/components/auth_image_template.vue'

export default {
  components: { AuthImageTemplate },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      status: false,
      password: '',
      email: '',
      ValidationErrors: [],
    }
  },
  computed: {
    appName() {
      // return $themeConfig.app.appName
      return this.$store.getters['app/appName']
    },
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  beforeCreate() {
    this.$http.get('/sanctum/csrf-cookie')
  },
  methods: {
    Login() {
      this.ValidationErrors = []
      this.$store.dispatch('auth/Login', {
        email: this.email,
        password: this.password,
        remember_me: this.status,
      }).then(() => {
        this.$store.dispatch('language/GetElements')
        this.$router.push({
          path: '/acp',
        })
      }).catch(error => {
        this.ValidationErrors = error.response.data.errors
      })
    },
    social_login(provider) {
      this.$store.dispatch('auth/SocialLoginAction', provider).then(response => {
        if (response.data.url) {
          window.location.href = response.data.url
        }
      })
    },

  },
}
</script>
