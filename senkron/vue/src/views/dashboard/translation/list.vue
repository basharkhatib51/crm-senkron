<template>
  <b-container>
    <b-modal
      v-model="UpdateElementModelStatus"
      :title="$t('Update Element')"
      size="lg"
      :ok-title="$t('Update')"
      :cancel-title="$t('cancel')"
      ok-variant="success"
      cancel-variant="danger"
      @close="CloseEdit"
      @cancel="CloseEdit"
      @ok="EditModalAction"
    >
      <h3>{{ element.content }}</h3>
      <b-tabs v-if="element">
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
              md="12"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="element[`content_${el.code}`]"
                  class="mt-2"
                  :placeholder="$t('Content')"
                />
                <label>{{ $t('Content') }}</label>
              </div>
            </b-col>
          </b-row>
        </b-tab>
      </b-tabs>
    </b-modal>
    <b-row>
      <b-col cols="12">
        <b-card>
          <h1>{{ $t('Translations') }}</h1>
          <b-table
            v-if="Elements.length>0"
            :fields="fields"
            responsive="sm"
            :items="Elements"
            :filter="filter"
            :per-page="perPage"
            :current-page="currentPage"
            class="table-w-max"
          >
            <template #cell(id)="data">
              <b-badge
                pill
                variant="light-primary"
              >
                {{ data.item.no }}
              </b-badge>
            </template>
            <template #cell(languages)="data">
              <b-avatar-group
                class="mb-2"
                size="32px"
              >
                <b-avatar
                  v-for="(el,index) in data.item.language_keys"
                  :key="index"
                  v-b-tooltip.hover
                  class="pull-up"
                  :title="Languages.find(e=>e.code===el).name"
                  :src="full_path(Languages.find(e=>e.code===el).image_url)"
                />
              </b-avatar-group>
              <b-progress
                max="100"
                :class="'w-100'"
              >
                <b-progress-bar
                  :value="data.item.content_translations_percentage"
                  :label-html="`${data.item.content_translations_percentage}%`"
                  :label="`${data.item.content_translations_percentage}%`"
                  :variant="data.item.content_translations_percentage>50?data.item.content_translations_percentage===100?'success':'warning':'danger'"
                />
              </b-progress>
            </template>
            <template
              #cell(created_at_updated_at)="data"
            >
              <div>
                <b-badge
                  v-if="data.item.created_at"
                  v-b-tooltip.hover="{title:data.item.created_at,variant:'success',placement:'top'}"
                  variant="light-success"
                >
                  <font-awesome-icon
                    :icon="['fas', 'table']"
                  />
                  {{ data.item.created_from }}
                </b-badge>
                <b-badge
                  v-if="data.item.updated_from"
                  v-b-tooltip.hover="{ title:data.item.updated_from,variant:'warning',placement:'top'}"
                  variant="light-warning"
                  class="ml-1"
                >
                  <font-awesome-icon
                    :icon="['fas', 'calendar-week']"
                  />
                  {{ data.item.updated_from }}
                </b-badge>
              </div>
            </template>
            <template #cell(options)="data">
              <b-button
                variant="success"
                @click="UpdateElement(data.item)"
              >
                <font-awesome-icon
                  :icon="['fas', 'language']"
                />
              </b-button>
            </template>
          </b-table>
          <b-row>
            <b-col
              cols="12"
              class="d-flex justify-content-end mt-2"
            >
              <b-pagination
                v-model="currentPage"
                :total-rows="totalRows"
                :per-page="perPage"
                align="center"
                size="sm"
                class="my-0"
              />
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>

export default {
  data() {
    return {
      filter: null,
      perPage: 5,
      currentPage: 1,
      errors: [],
      element: {},
      UpdateElementModelStatus: false,
    }
  },
  computed: {
    Elements() {
      return this.$store.getters['translation/GetElements']
    },
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'content', label: this.$t('content') },
        { key: 'languages', label: this.$t('languages') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    totalRows() {
      return this.Elements.length
    },
  },
  created() {
    this.getData()
  },
  methods: {

    UpdateElement(val) {
      this.UpdateElementModelStatus = true
      this.element = val
    },
    CloseEdit() {
      this.element = {}
      this.UpdateElementModelStatus = false
    },
    EditModalAction() {
      this.$store.dispatch('translation/Update', this.element)
      this.element = {}
      this.UpdateElementModelStatus = false
      this.getData()
    },
    getData() {
      this.$store.dispatch('translation/GetElements')
    },
  },
}
</script>
<style>
.progress {
    height: 16px;
}
</style>
