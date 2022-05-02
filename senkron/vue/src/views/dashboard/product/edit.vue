<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        lg="8"
      >
        <b-tabs>
          <b-tab :title="$t('Edit Product')">
            <b-col cols="12">
              <b-card
                :title="$t('Edit Product')"
              >
                <b-row>
                  <b-col
                    cols="6"
                  >
                    <div class="form-label-group">
                      <b-form-input
                        v-model="product_data.name"
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
                  <b-col
                    cols="6"
                  >
                    <div class="form-label-group">
                      <b-form-input
                        v-model="product_data.price"
                        class="mt-2"
                        type="number"
                        :state="errors.price ?false:null"
                        :placeholder="$t('Price')"
                      />
                      <small
                        v-if="errors.price"
                        class="text-danger"
                      >{{ errors.price[0] }}</small>
                      <label>{{ $t('Price') }}</label>
                    </div>
                  </b-col>
                  <b-col cols="12">
                    <div class="form-label-group">
                      <quill-upload v-model="product_data.description" />
                      <quill-editor
                        v-model="product_data.description"
                        :options="editorOption"
                        class="mt-2"
                      />
                      <small
                        v-if="errors.description"
                        class="text-danger"
                      >{{ errors.description[0] }}</small>
                      <label>{{ $t('Description') }}</label>
                    </div>
                  </b-col>
                </b-row>
              </b-card>
            </b-col>
          </b-tab>
          <b-tab :title="$t('Translation')">
            <b-col cols="12">
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
                            v-model="product_data[`name_${el.code}`]"
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
                      <b-col cols="12">
                        <div class="form-label-group">
                          <quill-upload v-model="product_data[`description_${el.code}`]" />
                          <quill-editor
                            v-model="product_data[`description_${el.code}`]"
                            :options="editorOption"
                            class="mt-2"
                          />
                          <small
                            v-if="errors[`description_${el.code}`]"
                            class="text-danger"
                          >{{ errors[`description_${el.code}`][0] }}</small>
                          <label>{{ $t('Description') }}</label>
                        </div>
                      </b-col>
                    </b-row>
                  </b-tab>
                </b-tabs>
              </b-card>
            </b-col>
          </b-tab>
        </b-tabs>
      </b-col>
      <b-col
        cols="12"
        lg="4"
      >
        <b-row>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Tags')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="product_data.tags"
                multiple
                :options="Tags"
                :reduce="Tags => Tags.id"
                label="name"
              />
              <small
                v-if="errors.tags"
                class="text-danger"
              >{{ errors.tags[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Categories')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="product_data.category"
                :options="Categories"
                :reduce="Categories => Categories.id"
                label="name"
              />
              <small
                v-if="errors.categories"
                class="text-danger"
              >{{ errors.categories[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Product Image')">
              <b-row>
                <b-col
                  cols="12"
                >
                  <upload
                    v-model="product_data.image_id"
                    @on-file-error="UpdateFileError"
                  />
                </b-col>
              </b-row>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Product Images')">
              <b-row>
                <b-col
                  cols="12"
                >
                  <multi-upload
                    v-model="product_data.images"
                  />
                </b-col>
              </b-row>
            </b-card>
          </b-col>
          <b-col cols="12">
            <create-detail @create-detail="CreateDetail" />
          </b-col>
          <b-col cols="12">
            <edit-detail
              v-model="editDetail"
              :data="editArray[indexDetail]"
              @edit-detail="ConfirmEdit"
            />
          </b-col>
          <b-col cols="12">
            <b-card :title="$t('Product Details')">
              <b-table
                v-if="items.length>0"
                :fields="fields"
                responsive="sm"
                :items="items"
                :per-page="perPage"
                :current-page="currentPage"
                class="table-w-max"
              >
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
          </b-col>
          <b-col cols="12">
            <b-card>
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    class="w-100"
                    variant="gradient-success"
                    @click="update"
                  >
                    {{ $t('Update') }}
                  </b-button>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import CreateDetail from '@/views/dashboard/product/components/CreateDetail.vue'
import EditDetail from '@/views/dashboard/product/components/EditDetail.vue'

export default {
  components: { EditDetail, CreateDetail },
  data() {
    return {
      product_data: {
        description: '',
        images: [],
        details: [],
      },
      errors: [],
      fileErrors: '',
      perPage: 5,
      currentPage: 1,
      editDetail: false,
      editArray: [],
      indexDetail: '',
    }
  },
  computed: {
    totalRows() {
      return this.items.length
    },
    items() {
      return this.product_data.details
    },
    fields() {
      return [
        { key: 'key', label: this.$t('key') },
        { key: 'value', label: this.$t('value') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    Element() { return this.$store.getters['product/GetElement'] },
    Tags() {
      return this.$store.getters['tag/GetElements']
    },
    Categories() {
      return this.$store.getters['category/GetElements']
    },
  },
  created() {
    this.$store.dispatch('category/GetElements')
    this.$store.dispatch('tag/GetElements')
    this.$store.dispatch('product/GetElement', this.$route.params.product).then(() => {
      this.product_data = this.Element
    })
  },
  methods: {
    ConfirmEdit(val) {
      if (this.indexDetail > -1) {
        this.product_data.details.splice(this.indexDetail, 1)
        this.product_data.details.push(val)
      }
    },
    CreateDetail(val) {
      this.product_data.details.push(val)
    },
    Delete(val) {
      if (val > -1) {
        this.product_data.details.splice(val, 1)
      }
    },
    Edit(array, index) {
      this.editDetail = true
      this.editArray = array
      this.indexDetail = index
    },
    resetData() {
      this.product_data = { details: [], images: [] }
      this.errors = []
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    update() {
      this.errors = []
      this.$store.dispatch('product/Update', { id: this.$route.params.product, data: this.product_data }).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
