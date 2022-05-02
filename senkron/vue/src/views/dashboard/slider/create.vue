<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="5"
      >
        <b-row>
          <b-col
            cols="12"
          >
            <b-row>
              <b-col cols="12">
                <b-tabs>
                  <b-tab :title="$t('Create New Slider')">
                    <b-card
                      :title="$t('Create New Slider')"
                    >
                      <b-row>
                        <b-col cols="12">
                          <div class="form-label-group">
                            <b-form-input
                              v-model="slider_data.name"
                              class="mt-2"
                              :state="errors.name ?false:null"
                              :placeholder="$t('Name')"
                            />
                            <small
                              v-if="errors.name"
                              class="text-danger"
                            >{{ errors.name[0] }}</small>
                            <label>{{ $t('Name') }}</label>
                          </div>
                        </b-col>
                      </b-row>
                    </b-card>
                  </b-tab>
                  <b-tab :title="$t('Translation')">
                    <b-card
                      :title="$t('Multi Language Columns')"
                    >
                      <b-tabs>
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
                            >
                              <div class="form-label-group">
                                <b-form-input
                                  v-model="slider_data[`name_${el.code}`]"
                                  class="mt-2"
                                  :state="errors.name ?false:null"
                                  :placeholder="$t('Name')"
                                />
                                <small
                                  v-if="errors.name"
                                  class="text-danger"
                                >{{ errors.name[0] }}</small>
                                <label>{{ $t('Name') }}</label>
                              </div>
                            </b-col>
                          </b-row>
                        </b-tab>
                      </b-tabs>
                    </b-card>
                  </b-tab>
                </b-tabs>
              </b-col>
            </b-row>
          </b-col>
          <b-col cols="12">
            <create-element @create-element="CreateElement" />
          </b-col>
          <b-col cols="12">
            <edit-element
              v-model="editElement"
              :data="editArray[indexElement]"
              @edit-element="ConfirmEdit"
            />
          </b-col>
        </b-row>
      </b-col>
      <b-col
        cols="12"
        md="7"
      >
        <b-card :title="$t('Slider Elements')">
          <b-table
            v-if="items.length>0"
            :fields="fields"
            responsive="sm"
            :items="items"
            :per-page="perPage"
            :current-page="currentPage"
            class="table-w-max"
          >
            <template #cell(image_url)="data">
              <b-avatar
                v-if="data.item.image"
                class="m-auto"
                :src="path(data.value)"
                size="40px"
              />
            </template>
            <template #cell(background_url)="data">
              <b-avatar
                v-if="data.item.background"
                class="m-auto"
                :src="path(data.value)"
                size="40px"
              />
            </template>
            <template #cell(options)="data">
              <div class="w-max">
                <a
                  class="text-success"
                  @click="Edit(items,items.indexOf(data.item))"
                >
                  <font-awesome-icon
                    :icon="['fas', 'edit']"
                  />
                </a>
                <a
                  class="ml-2 text-danger"
                  @click="Delete(items.indexOf(data.item))"
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
        </b-card>
        <b-row>
          <b-col cols="12">
            <b-card>
              <b-button
                class="w-100"
                variant="gradient-success"
                @click="create"
              >
                {{ $t('Create') }}
              </b-button>
            </b-card>
          </b-col>
          <b-col>
            <b-alert
              variant="warning"
              show
            >
              <div class="alert-body text-center">
                <span>{{ $t('after adding elements you should Create the slider') }}</span>
              </div>
            </b-alert>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import CreateElement from '@/views/dashboard/slider/components/CreateElement.vue'
import EditElement from '@/views/dashboard/slider/components/EditElement.vue'

export default {
  components: { EditElement, CreateElement },
  data() {
    return {
      slider_data: {
        elements: [],
      },
      perPage: 5,
      currentPage: 1,
      errors: [],
      fileErrors: '',
      editElement: false,
      editArray: [],
      indexElement: '',

    }
  },
  computed: {
    fields() {
      return [
        { key: 'title', label: this.$t('title') },
        { key: 'image_url', label: this.$t('image') },
        { key: 'background_url', label: this.$t('background') },
        { key: 'content_position', label: this.$t('Content Position') },
        { key: 'content', label: this.$t('content') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    totalRows() {
      return this.items.length
    },
    items() {
      return this.slider_data.elements
    },
  },
  methods: {
    path(val) {
      return this.full_path(val)
    },
    ConfirmEdit(val) {
      if (this.indexElement > -1) {
        this.slider_data.elements.splice(this.indexElement, 1)
        this.slider_data.elements.push(val)
      }
    },
    CreateElement(val) {
      this.slider_data.elements.push(val)
    },
    resetData() {
      this.slider_data = {
        elements: [],
      }
      this.errors = []
    },
    Edit(array, index) {
      this.editElement = true
      this.editArray = array
      this.indexElement = index
    },
    Delete(val) {
      if (val > -1) {
        this.slider_data.elements.splice(val, 1)
      }
    },
    create() {
      this.errors = []
      this.$store.dispatch('slider/Create', this.slider_data).then(() => {
        this.slider_data = {
          name: '',
          elements: [],
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
