<template>
  <div>
    <b-modal
      v-model="restoreElement"
      :title="$t('Restore Language')"
      :ok-title="$t('Restore')"
      :cancel-title="$t('cancel')"
      ok-variant="success"
      cancel-variant="primary"
      @close="restoreElement=false"
      @cancel="restoreElement=false"
      @ok="ConfirmRestore"
    >
      <b-badge
        class="mt-1"
        variant="light-success"
      >
        {{ $t('are you sure you want to restore this Language') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('Languages') }}
    </h3>
    <b-row>
      <b-col cols="12">
        <b-button
          variant="gradient-success"
          @click="$router.push({name:'language.list'})"
        >
          <font-awesome-icon
            :icon="['fas', 'arrow-left']"
          />
          {{ $t('Languages') }}
        </b-button>
      </b-col>
    </b-row>
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
      <b-card
        class="mt-5"
      >
        <b-card-title>
          <b-row>
            <b-col cols="8">
              <h3>
                {{ $t('Languages') }}
              </h3>
            </b-col>
            <b-col
              cols="4"
            >
              <b-input-group>
                <b-form-input
                  id="filter-input"
                  v-model="filter"
                  type="search"
                  :placeholder="$t('Type to Search')"
                />
              </b-input-group>
            </b-col>
          </b-row>
        </b-card-title>
        <b-table
          v-if="items.length>0"
          :fields="fields"
          responsive="sm"
          :filter="filter"
          :items="items"
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
          <template
            #cell(created_at_updated_at_deleted_at)="data"
          >
            <div>
              <b-badge
                v-b-tooltip.hover="{title:data.item.created_at,variant:'success',placement:'top'}"
                variant="light-success"
              >
                <font-awesome-icon
                  :icon="['fas', 'table']"
                />
                {{ data.item.created_from }}
              </b-badge>
              <b-badge
                v-b-tooltip.hover="{ title:data.item.created_at,variant:'warning',placement:'top'}"
                variant="light-warning"
                class="ml-1"
              >
                <font-awesome-icon
                  :icon="['fas', 'calendar-week']"
                />
                {{ data.item.updated_from }}
              </b-badge>
              <b-badge
                v-b-tooltip.hover="{ title:data.item.deleted_at,variant:'danger',placement:'top'}"
                variant="light-danger"
                class="ml-1"
              >
                <font-awesome-icon
                  :icon="['fas', 'calendar-times']"
                />
                {{ data.item.deleted_from }}
              </b-badge>
            </div>
          </template>
          <template #cell(pages)="data">
            <b-badge
              pill
              variant="light-primary"
            >
              {{ data.item['pages_count'] }} Pages
            </b-badge>
          </template>

          <template #cell(options)="data">
            <div class="w-max">
              <a
                class="ml-1 text-success"
                @click="RestoreLanguage(data.item.id)"
              >
                <font-awesome-icon
                  :icon="['fas', 'trash-restore']"
                />
                {{ data.value }}
              </a>
            </div>
          </template>
        </b-table>
        <b-row
          v-else
          class="d-flex justify-content-center"
        >
          <b-col
            cols="4"
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
    </b-overlay>
    <trashed-exp />
  </div>
</template>
<script>
import TrashedExp from '@components/TrashedExp.vue'

export default {
  components: {
    TrashedExp,
  },
  data() {
    return {
      restoreElement: false,
      changeStatus: false,
      changePassword: false,
      perPage: 5,
      currentPage: 1,
      element: null,
      filter: null,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'name', label: this.$t('name') },
        { key: 'english_name', label: this.$t('english_name') },
        { key: 'code', label: this.$t('code') },
        { key: 'created_at_updated_at_deleted_at', label: this.$t('created_at_updated_at_deleted_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    items() {
      return this.$store.getters['language/Trashed']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('language/GetTrashed')
  },
  methods: {
    RestoreLanguage(val) {
      this.restoreElement = true
      this.element = val
    },
    ConfirmRestore() {
      this.$store.dispatch('language/Restore', this.element)
    },
  },
}
</script>
