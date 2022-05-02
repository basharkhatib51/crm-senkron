<template>
  <div>
    <b-modal
      ref="my-modal"
      v-model="isActive"
      :title="$t('Permissions')"
      :ok-title="$t('Close')"
      ok-only
      ok-variant="outline-primary"
      no-close-on-backdrop
      @ok="close"
      @close="close"
      @hide="close"
    >
      <b-overlay
        :show="elementLoading"
        rounded="sm"
        variant="transparent"
        :opacity="0.8"
        blur="2px"
        spinner-variant="primary"
        spinner-type="grow"
        spinner-small
      >
        <b-row>
          <b-col
            v-if="roleData.permissions.length>0"
            cols="12"
            class="mt-1"
          >
            <b-badge
              v-for="(tr, indextr) in roleData.permissions"
              :key="indextr"
              variant="light-primary"
              class="mr-1 mb-1"
            >
              {{ tr.name }}
            </b-badge>
          </b-col>
          <b-col
            v-else
            class="d-flex justify-content-center"
          >
            <b-alert
              variant="danger"
              show
            >
              <div class="alert-body text-center">
                <span>{{ $t('No Data Available') }}</span>
              </div>
            </b-alert>
          </b-col>
        </b-row>
      </b-overlay>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'Permissions',
  props: {
    value: {
      default: null,
      type: Boolean,
    },
    role: {
      default: null,
      type: Number,
    },
  },
  data: () => ({
    roleData: {
      permissions: [],
    },
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
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('role/GetElement', this.role).then(response => {
          this.roleData = response.data.role
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
    },
  },
}
</script>
