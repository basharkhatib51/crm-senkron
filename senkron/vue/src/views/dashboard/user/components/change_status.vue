<template>
  <div>
    <b-modal
      v-model="isActive"
      :title="$t('Change Status')"
      hide-footer
      no-close-on-backdrop
      @close="close"
      @hide="close"
    >
      <b-badge
        v-if="userData.status==='active'"
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to Block this user') }}
      </b-badge>
      <b-badge
        v-if="userData.status==='blocked' || userData.status==='deactivated' "
        class="mt-1"
        variant="light-success"
      >
        {{ $t('are you sure you want to activate this user') }}
      </b-badge>
      <br>
      <b-badge
        v-if="userData.status==='blocked'"
        class="mt-2"
        variant="light-danger"
      >
        {{ $t('this user was blocked because') }} {{ userData.blocked_reason }}
      </b-badge>
      <div v-if="userData.status==='active'">
        <div class="form-label-group">
          <b-form-input
            v-model="userData.blocked_reason"
            class="mt-3"
            :placeholder="$t('Blocked Reason')"
          />
          <label>{{ $t('Blocked Reason') }}</label>
        </div>
      </div>

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
            class="ml-1"
            variant="success"
            @click="ChangeStatus"
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
  name: 'ChangeStatus',
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
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('user/GetElement', this.user).then(() => {
          this.userData = this.User
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
      this.userData = {}
    },
    ChangeStatus() {
      if (this.userData.status === 'active') {
        this.userData.status = 'blocked'
      } else if (this.userData.status === 'deactivated' || this.userData.status === 'blocked') {
        this.userData.status = 'active'
      }
      this.$store.dispatch('user/ChangeStatus', this.userData).then(() => {
        this.close()
      })
    },
  },
}
</script>

<style lang="scss">
</style>
