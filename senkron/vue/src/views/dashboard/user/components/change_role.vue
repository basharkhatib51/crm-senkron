<template>
  <div>

    <b-modal
      ref="my-modal"
      v-model="isActive"
      :title="$t('Change Role')"
      no-close-on-backdrop
      hide-footer
      @close="close"
      @hide="close"
    >
      <b-row>
        <b-col
          cols="12"
          class="mt-2 mb-2"
        >
          <label>{{ $t('Roles') }}</label>
          <v-select
            v-model="selectedRole"
            :options="Roles"
            :reduce="Roles => Roles.id"
            label="name"
          />
          <small
            v-if="errors.permissions"
            class="text-danger"
          >{{ errors.permissions[0] }}</small>
        </b-col>
      </b-row>
      <b-row>
        <b-col
          cols="12"
          class="mt-2 d-flex justify-content-end"
        >
          <b-button
            variant="primary"
            @click="close"
          >
            {{ $t('Cancel') }}
          </b-button>
          <b-button
            variant="success"
            class="ml-1"
            @click="ChangeRole"
          >
            {{ $t('Confirm') }}
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'ChangeRole',
  props: {
    value: {
      default: null,
      type: Boolean,
    },
    user: {
      default: null,
      type: Number,
    },
  },
  data: () => ({
    errors: [],
    selectedRole: null,
    userData: {},
  }),
  computed: {
    isActive: {
      get() {
        return this.getData()
      },
      set(val) {
        this.$emit('input', val)
      },
    },
    User() {
      return this.$store.getters['user/GetElement']
    },
    Roles() {
      return this.$store.getters['role/Elements']
    },
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('user/GetElement', this.user).then(() => {
          this.userData = this.User
          this.$store.dispatch('role/GetElements').then(() => {
            this.selectedRole = this.userData.role_id
          })
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
      this.userData = {}
      this.selectedRole = null
    },
    ChangeRole() {
      this.$store.dispatch('user/ChangeRole', { role_id: this.selectedRole, user: this.userData.id }).then(() => {
        this.close()
      })
    },
  },
}
</script>

<style lang="scss">
</style>
