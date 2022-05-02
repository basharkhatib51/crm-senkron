<template>
  <b-container
    class="builder"
    fluid
  >
    <b-modal
      v-model="new_section_model"
      :title="$t('Create New Section')"
      :ok-title="$t('Close')"
      hide-footer
      size="xl"
      centered
      modal-class="modal-primary new-section-model"
      ok-variant="outline-primary"
      no-close-on-backdrop
    >
      <b-row>
        <b-col
          cols="6"
          class="py-1"
        >
          <b-button
            variant="outline-warning"
            block
            @click="add_new_section_columns(12)"
          >
            <b-avatar
              size="100%"
              rounded="lg"
              text="100%"
              variant="light-success"
            />
          </b-button>
        </b-col>
        <b-col
          cols="6"
          class="py-1"
        >
          <b-button
            variant="outline-warning"
            block
            @click="add_new_section_columns(6)"
          >
            <b-row>
              <b-col
                v-for="e in 2"
                :key="e"
                cols="6"
              >
                <b-avatar
                  size="100%"
                  rounded="lg"
                  text="50%"
                  variant="light-success"
                />
              </b-col>
            </b-row>
          </b-button>
        </b-col>
        <b-col
          cols="6"
          class="py-1"
        >
          <b-button
            variant="outline-warning"
            block
            @click="add_new_section_columns(4)"
          >
            <b-row>
              <b-col
                v-for="e in 3"
                :key="e"
                cols="4"
              >
                <b-avatar
                  size="100%"
                  rounded="lg"
                  text="33%"
                  variant="light-success"
                />
              </b-col>
            </b-row>
          </b-button>
        </b-col>
        <b-col
          cols="6"
          class="py-1"
        >
          <b-button
            variant="outline-warning"
            block
            @click="add_new_section_columns(3)"
          >
            <b-row>
              <b-col
                v-for="e in 4"
                :key="e"
                cols="3"
              >
                <b-avatar
                  size="100%"
                  rounded="lg"
                  text="25%"
                  variant="light-success"
                />
              </b-col>
            </b-row>
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
    <b-modal
      v-model="new_element_model"
      :title="$t('Create New Element')"
      :ok-title="$t('Close')"
      hide-footer
      size="lg"
      centered
      modal-class="modal-primary new-section-model"
      ok-variant="outline-primary"
      no-close-on-backdrop
    >
      <b-row>
        <b-col cols="6">
          <div class="form-label-group">
            <b-form-input
              v-model="element.title"
              class="mt-2"
              :placeholder="$t('Title')"
            />
            <label>{{ $t('Title') }}</label>
          </div>
        </b-col>
        <b-col
          cols="6"
          class="d-flex justify-content-center"
        >
          <upload
            v-model="element.image"
          />
        </b-col>
        <b-col
          cols="12"
          md="12"
        >
          <div class="form-label-group">
            <b-form-textarea
              v-model="element.excerpt"
              rows="4"
              class="mt-2"
              :placeholder="$t('Excerpt')"
            />
            <label>{{ $t('Excerpt') }}</label>
          </div>
        </b-col>
        <b-col cols="12">
          <b-button
            variant="success"
            @click="add_new_element_columns"
          >
            {{ $t('Add Element') }}
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
    <b-row>
      <b-col>
        <b-card
          bg-variant="builder-variant"
          border-variant="warning"
        >
          <b-row>
            <b-col
              v-if="sections.length===0"
              class="my-3"
              cols="12"
            >
              <b-alert
                variant="warning"
                show
              >
                <div class="alert-body text-center">
                  <span> {{ $t('Please Add') }} <strong> {{ $t('Section') }} </strong> {{ $t('or') }}<strong> {{ $t('Slider') }} </strong> {{ $t('Firstly') }}</span>
                </div>
              </b-alert>
            </b-col>
            <b-col
              v-else
              class="my-3"
              cols="12"
            >
              <b-alert
                v-for="(section,index) in sections"
                :key="index"
                variant="success"
                show
              >
                <div
                  class="alert-heading"
                >
                  <b-row align-h="between">
                    <b-col
                      cols="auto"
                    >
                      {{ section.name }}
                    </b-col>
                    <b-col
                      cols="auto"
                    >
                      <b-row>
                        <b-col
                          cols="auto"
                        >
                          <font-awesome-icon
                            class="text-warning"
                            :icon="['fas', 'edit']"
                            size="sm"
                            @click="edit_section(index)"
                          />
                        </b-col>
                        <b-col
                          cols="auto"
                        >
                          <font-awesome-icon
                            class="text-warning"
                            :icon="['fas', 'copy']"
                            size="sm"
                            @click="copy_section(section)"
                          />
                        </b-col>
                        <b-col
                          cols="auto"
                        >
                          <font-awesome-icon
                            class="text-danger"
                            :icon="['fas', 'trash-alt']"
                            size="sm"
                            @click="delete_section(index)"
                          />
                        </b-col>
                      </b-row>

                    </b-col>
                  </b-row>
                </div>
                <div class="alert-body text-center">
                  <b-row class="py-1">
                    <b-col
                      v-for="(element,element_index) in section.elements"
                      :key="element_index"
                      class="py-1"
                      :cols="section.elements_col"
                    >
                      {{ section.elements_col }} {{ element }}
                    </b-col>
                    <b-col
                      v-for="(element,element_index) in get_elements_col_count(section)"
                      :key="element_index"
                      class="py-1"
                      :cols="section.elements_col"
                    >
                      <b-button
                        variant="outline-warning"
                        size="sm"
                        pill
                        @click="create_new_element_columns(index)"
                      >
                        <font-awesome-icon
                          :icon="['fas', 'plus-square']"
                        />
                        {{ get_elements_col_count(section) }}{{ $t('Add Element') }}
                      </b-button>
                    </b-col>
                  </b-row>
                </div>
              </b-alert>
            </b-col>
            <b-col class="text-center">
              <b-button
                variant="outline-warning"
                pill
                size="sm"
                @click="create_new_section_columns"
              >
                <font-awesome-icon
                  :icon="['fas', 'columns']"
                />
                {{ $t('Create New Section') }}
              </b-button>
            </b-col>
            <b-col class="text-center">
              <b-button
                variant="outline-warning"
                size="sm"
                pill
              >
                <font-awesome-icon
                  :icon="['fas', 'images']"
                />
                {{ $t('Add Slider') }}
              </b-button>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>

export default {
  name: 'Builder',
  props: {
    value: {
      default: null,
      type: String,
    },
  },
  data() {
    return {
      element: {},
      sections: [],
      new_section_model: false,
      new_slider_model: false,
      new_element_model: false,
    }
  },
  methods: {
    get_elements_col_count(val) {
      return 12 / val.elements_col + ((val.elements.length > 0 ? val.elements.length % (12 / val.elements_col) : 0))
    },
    close() {
      this.new_section_model = false
    },
    create_new_section_columns() {
      this.new_section_model = true
    },
    create_new_element_columns(val) {
      this.element.slider_index = val
      this.new_element_model = true
    },
    delete_section(val) {
      this.sections.splice(val, 1)
    },
    edit_section(val) {
      console.log(val)
    },
    copy_section(val) {
      this.sections.push(val)
    },
    add_new_element_columns() {
      console.log(this.element)
      this.sections[this.element.slider_index].elements.push(this.element)
      this.element = {}
      this.new_element_model = false
    },
    add_new_section_columns(val) {
      this.new_section_model = false
      this.sections.push({
        elements_col: val,
        elements: [],
        name: `section ${this.sections.length + 1}`,
        elements_color: '',
        padding: '',
        margin: '',
        elements_padding: '',
        elements_margin: '',
        container: 'wide',
        background: null,
        type: 'cols',
      })
    },
  },
}
</script>
