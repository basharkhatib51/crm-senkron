<template>
  <div>
    <b-modal
      v-model="deleteElement"
      :title="$t('Delete Product')"
      :ok-title="$t('Delete')"
      :cancel-title="$t('cancel')"
      ok-variant="danger"
      cancel-variant="primary"
      @close="deleteElement=false"
      @cancel="deleteElement=false"
      @ok="ConfirmDelete"
    >
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to delete this Product') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('Products') }}
    </h3>
    <b-row>
      <b-col cols="6">
        <b-button
          variant="gradient-success"
          @click="$router.push({name:'product.create'})"
        >
          {{ $t('Create new') }}
        </b-button>
      </b-col>
      <b-col
        cols="6"
        class="d-flex justify-content-end"
      >
        <b-button
          variant="gradient-danger"
          @click="$router.push({name:'product.trashed'})"
        >
          <font-awesome-icon
            :icon="['fas', 'trash']"
          />
          {{ $t('Trashed') }}
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
                {{ $t('Products') }}
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
          :items="items"
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
          <template #cell(name)="data">
            {{ data.item.name }}
          </template>
          <template #cell(image)="data">
            <b-avatar
              :src="full_path(data.value)"
            />
          </template>
          <template #cell(category_name)="data">
            <b-badge
              v-if="data.value"
              variant="light-primary"
            >
              {{ data.value }}
            </b-badge>
            <b-badge
              v-else
              variant="light-danger"
            >
              {{ $t('Not related yet') }}
            </b-badge>
          </template>
          <template #cell(tags_count)="data">
            <b-badge
              variant="light-primary"
            >
              {{ data.value }}
            </b-badge>
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
          </template>s
          <template #cell(options)="data">
            <div class="w-max">
              <router-link
                class="text-success"
                :to="{name:'product.edit',params: { product: data.item.id }}"
              >
                <font-awesome-icon
                  :icon="['fas', 'edit']"
                />
              </router-link>
              <a
                class="ml-2 text-danger"
                @click="Delete(data.item.id)"
              >
                <font-awesome-icon
                  :icon="['fas', 'trash']"
                />
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
    <list-exp />
  </div>
</template>

<script>

import ListExp from '@components/ListExplain.vue'

export default {
  components: { ListExp },
  data() {
    return {
      deleteElement: false,
      element: null,
      filter: null,
      perPage: 5,
      currentPage: 1,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'name', label: this.$t('name') },
        { key: 'image', label: this.$t('image') },
        { key: 'tags_count', label: this.$t('tags count') },
        { key: 'category_name', label: this.$t('category') },
        { key: 'created_at_updated_at', label: this.$t('created at updated at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    items() {
      return this.$store.getters['product/GetElements']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('product/GetElements')
  },
  methods: {
    Delete(val) {
      this.deleteElement = true
      this.element = val
    },
    ConfirmDelete() {
      this.$store.dispatch('product/Delete', this.element)
    },
  },
}
</script>
