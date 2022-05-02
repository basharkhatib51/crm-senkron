<template>
  <b-card :title="$t('Setting')">
    <b-tabs justified>
      <b-tab
        v-for="(val,index) in data"
        :key="index"
      >
        <template #title>
          <span>{{ $t(index) }}</span>
        </template>
        <b-card-body>
          <b-row>
            <b-col
              v-for="(item,i) in val"
              :key="i"
              cols="12"
              md="6"
              xl="4"
              class="mt-2"
            >
              <div
                v-if="item.type==='string'"
                class="form-label-group"
              >
                <b-form-input
                  v-model="item.value"
                  :placeholder="$t(item.key)"
                />
                <label>{{ $t(item.key) }}</label>
              </div>
              <div
                v-if="item.type==='enum'"
                class="form-label-group"
              >
                <v-select
                  v-model="item.value"
                  :options="item.options"
                />
                <label>{{ $t(item.key) }}</label>
              </div>
              <div
                v-if="item.type==='text'"
                class="form-label-group"
              >
                <b-form-textarea
                  id="textarea-default"
                  v-model="item.value"
                  :placeholder="$t(item.key)"
                  rows="3"
                />
                <label>{{ $t(item.key) }}</label>
              </div>
              <div
                v-if="item.type==='number'"
                class="form-label-group"
              >
                <b-form-input
                  v-model="item.value"
                  :placeholder="$t(item.key)"
                />
                <label>{{ $t(item.key) }}</label>
              </div>
              <div
                v-if="item.type==='image'"
                class="form-label-group text-center"
              >
                <label>{{ $t(item.key) }}</label>
                <upload v-model="item.value" />
              </div>
              <div
                v-if="item.type==='boolean'"
                class="form-label-group"
              >
                <div class="demo-inline-spacing">
                  <b-form-checkbox
                    v-model="item.value"
                    :value="true"
                  >
                    {{ $t(item.key) }}
                  </b-form-checkbox>
                  <label>{{ $t(item.key) }}</label>
                </div>
              </div>
            </b-col>
          </b-row>
        </b-card-body>
      </b-tab>
    </b-tabs>
    <b-row>
      <b-col
        cols="12"
        class="d-flex justify-content-end"
      >
        <b-button
          variant="success"
          @click="updateSettings"
        >
          {{ $t('Save') }}
        </b-button>
      </b-col>
    </b-row>
  </b-card>
</template>
<script>
export default {
  components: {
  },
  data() {
    return {
      data: {},
    }
  },
  created() {
    this.getSettings()
  },
  methods: {
    getSettings() {
      this.$http.get('settings/groups').then(response => {
        this.data = response.data.data
      })
    },
    updateSettings() {
      this.$http.put('settings/update', this.data).then(() => {
        this.getSettings()
      })
    },
  },
}
</script>
