<template>
  <div>
    <change-status
      v-model="changeStatus"
      :user="user"
    />
    <change-password
      v-model="changePassword"
      :user="user"
    />
    <change-role
      v-model="changeRole"
      :user="user"
    />
    <b-modal
      v-model="deleteUser"
      :title="$t('Delete User')"
      :ok-title="$t('Delete')"
      :cancel-title="$t('cancel')"
      ok-variant="danger"
      cancel-variant="primary"
      @close="deleteUser=false"
      @cancel="deleteUser=false"
      @ok="ConfirmDelete"
    >
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to delete this User') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('Users') }}
    </h3>
    <b-row>
      <b-col cols="6">
        <b-button
          variant="gradient-success"
          @click="$router.push({name:'user.create'})"
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
          @click="$router.push({name:'user.trashed'})"
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
                {{ $t('Users') }}
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
          <template #cell(avatar)="data">
            <b-avatar
              :src="path(data.value)"
            />
          </template>
          <template #cell(name)="data">
            <div>
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'id-card']"
              />
              {{ data.item.first_name }}
              {{ data.item.last_name }}
            </div>
          </template>

          <template #cell(user_name)="data">
            <div>

              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'user']"
              />
              {{ data.value }}
            </div>
          </template>
          <template #cell(contact)="data">
            <div>

              <div
                v-if="data.item.email"
                v-b-tooltip.hover="{title:'Press to send email',variant:'primary',placement:'top'}"
              >
                <font-awesome-icon
                  class="text-primary"
                  :icon="['fas', 'envelope']"
                />
                <a :href="'mailto:'+data.item.email">
                  {{ data.item.email }}
                </a>
              </div>
              <div
                v-if="data.item.phone"
                v-b-tooltip.hover="{title:'Press to make call',variant:'primary',placement:'top'}"
              >
                <font-awesome-icon
                  class="text-primary"
                  :icon="['fas', 'phone']"
                />
                <a :href="'tel:'+data.item.phone">
                  {{ data.item.phone }}
                </a>
              </div>
            </div>
          </template>
          <template
            #cell(created_at_updated_at)="data"
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
            </div>
          </template>
          <template #cell(role)="data">
            <b-badge variant="light-primary">
              <font-awesome-icon
                class="mr-1"
                :icon="['fas', 'key']"
              />
              <span v-if="data.value">
                {{ data.value }}
              </span>
              <span v-else>
                No Roles Yet
              </span>
              <b-badge
                v-if=" data.value"
                class="badge-glow ml-1"
                pill
                variant="primary"
              >{{ data.item.permissions.length }}
              </b-badge>
            </b-badge>
          </template>
          <template #cell(options)="data">
            <div>
              <router-link
                class="text-success"
                :to="{name:'user.edit',params: { user: data.item.id }}"
              >
                <font-awesome-icon
                  :icon="['fas', 'edit']"
                />
              </router-link>
              <a
                class="ml-1 text-danger"
                @click="Delete(data.item.id)"
              >

                <font-awesome-icon
                  :icon="['fas', 'trash']"
                />
              </a>
              <a
                class="ml-1 text-warning"
                @click="ChangePassword(data.item.id)"
              >
                <font-awesome-icon
                  :icon="['fas', 'key']"
                />
              </a>
              <a
                class="ml-1"
                @click="ChangeStatus(data.item.id)"
              >
                <font-awesome-icon
                  v-b-tooltip.hover="{title:data.item.status,variant:data.item.status==='active'?'success':'danger',placement:'top'}"
                  :class="(data.item.status==='active'?'text-success':'text-danger')"
                  :icon="['fas', (data.item.status==='active'?'toggle-on':'toggle-off')]"
                />
              </a>
              <a
                class="ml-1 text-info"
                @click="ChangeRole(data.item.id)"
              >
                <font-awesome-icon
                  :icon="['fas', 'user-shield']"
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
    <user-exp />
  </div>
</template>

<script>

import ChangePassword from '@/views/dashboard/user/components/change_password.vue'
import UserExp from '@/views/dashboard/user/components/explain.vue'
import ChangeRole from '@/views/dashboard/user/components/change_role.vue'
import ChangeStatus from '@/views/dashboard/user/components/change_status.vue'

export default {
  components: {
    ChangeStatus,
    ChangeRole,
    UserExp,
    ChangePassword,
  },
  data() {
    return {
      deleteUser: false,
      changeStatus: false,
      changePassword: false,
      changeRole: false,
      user: null,
      perPage: 5,
      currentPage: 1,
      filter: null,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'avatar', label: this.$t('avatar') },
        { key: 'name', label: this.$t('name') },
        { key: 'user_name', label: this.$t('user_name') },
        { key: 'contact', label: this.$t('contact') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'role', label: this.$t('role') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    auth() {
      return this.$store.getters['auth/GetAuth']
    },
    items() {
      return this.$store.getters['user/GetElements']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('user/GetElements')
  },
  methods: {
    path(val) {
      return this.full_path(val)
    },
    Delete(val) {
      this.deleteUser = true
      this.user = val
    },
    ConfirmDelete() {
      this.$store.dispatch('user/Delete', this.user)
    },
    ChangeStatus(val) {
      this.user = val
      this.changeStatus = true
    },
    ChangeRole(val) {
      this.user = val
      this.changeRole = true
    },
    ChangePassword(val) {
      this.changePassword = true
      this.user = val
    },
  },
}
</script>

<style>

</style>
