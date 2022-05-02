<template>
    <b-container>
        <b-modal
            v-model="createElementModelStatus"
            no-close-on-backdrop
            :title="$t('Create new Element')"
            size="lg"
            :ok-title="$t('Add')"
            :cancel-title="$t('cancel')"
            ok-variant="success"
            cancel-variant="danger"
            @close="CloseCreate"
            @cancel="CloseCreate"
            @ok="CreateModalAction"
        >
            <b-tabs v-if="selectedSection">
                <b-tab :title="$t('Create Element')">
                    <b-row>
                        <b-col
                            cols="12"
                            md="9"
                        >
                            <b-row>
                                <b-col
                                    cols="12"
                                    md="12"
                                >
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
                                    v-if="sections.find(e=>(e.id===selectedSection)).link"
                                    cols="12"
                                    md="12"
                                >
                                    <b-row>
                                        <b-col
                                            cols="12"
                                            md="6"
                                        >
                                            <div class="form-label-group">
                                                <b-form-input
                                                    v-model="element.url"
                                                    class="mt-2"
                                                    :placeholder="$t('Url')"
                                                />
                                                <label>{{ $t('Url') }}</label>
                                            </div>
                                        </b-col>
                                        <b-col
                                            cols="12"
                                            md="6"
                                        >
                                            <div>
                                                <label>{{ $t('Page') }}</label>
                                                <v-select
                                                    v-model="element.page_id"
                                                    label="title"
                                                    :reduce="pages => pages.id"
                                                    :options="pages"
                                                />
                                            </div>
                                        </b-col>
                                    </b-row>
                                </b-col>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).icon"
                                    cols="12"
                                    md="6"
                                    class="mt-2 mb-2"
                                >
                                    <label>{{ $t('Pack') }}</label>
                                    <v-select
                                        v-model="element.pack"
                                        :options="['fas','fab','far','feather']"
                                    />
                                    <small
                                        v-if="errors['icon']"
                                        class="text-danger"
                                    >{{ errors['icon'][0] }}</small>
                                </b-col>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).icon"
                                    cols="12"
                                    md="6"
                                    class="mt-2 mb-2"
                                >
                                    <label>Icon</label>
                                    <v-select
                                        v-model="element.icon"
                                        :options="icons[element.pack]"
                                    >
                                        <template #option="option">
                                            <font-awesome-icon
                                                v-if="['fas','fab','far'].includes(element.pack)"
                                                class="text-primary"
                                                :icon="[element.pack, option.label]"
                                            />
                                            <feather-icon
                                                v-else-if="['feather'].includes(element.pack)"
                                                :icon="option.label || 'CircleIcon'"
                                            />
                                            <feather-icon
                                                v-else
                                                icon="CircleIcon"
                                            />
                                            <span> {{ option.label }} </span>
                                        </template>

                                    </v-select>
                                </b-col>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).description"
                                    cols="12"
                                    md="12"
                                >
                                    <div class="form-label-group">
                                        <b-form-textarea
                                            v-model="element.description"
                                            rows="4"
                                            class="mt-2"
                                            :placeholder="$t('Description')"
                                        />
                                        <label>{{ $t('Description') }}</label>
                                    </div>
                                </b-col>
                            </b-row>
                        </b-col>
                        <b-col
                            cols="12"
                            md="3"
                        >
                            <b-row>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).image"
                                    cols="12"
                                    md="12"
                                >
                                    <upload
                                        v-model="element.image_id"
                                        @update-url="SetBackgroundUrl"
                                    />
                                </b-col>
                            </b-row>
                        </b-col>
                    </b-row>
                </b-tab>
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
                                    v-model="element[`title_${el.code}`]"
                                    class="mt-2"
                                    :placeholder="$t('Title')"
                                />
                                <label>{{ $t('Title') }}</label>
                            </div>
                        </b-col>
                        <b-col
                            v-if="sections.find(e=>(e.id===selectedSection)).description"
                            cols="12"
                            md="12"
                        >
                            <div class="form-label-group">
                                <b-form-textarea
                                    v-model="element[`description_${el.code}`]"
                                    rows="4"
                                    class="mt-2"
                                    :placeholder="$t('Description')"
                                />
                                <label>{{ $t('Description') }}</label>
                            </div>
                        </b-col>

                    </b-row>
                </b-tab>
            </b-tabs>
        </b-modal>
        <b-modal
            v-model="UpdateElementModelStatus"
            :title="$t('Update Element')"
            no-close-on-backdrop
            size="lg"
            :ok-title="$t('Update')"
            :cancel-title="$t('cancel')"
            ok-variant="success"
            cancel-variant="danger"
            @close="CloseEdit"
            @cancel="CloseEdit"
            @ok="EditModalAction"
        >
            <b-tabs v-if="selectedSection && selectedElement!==null">
                <b-tab :title="$t('Edit Element')">
                    <b-row>

                        <b-col
                            cols="12"
                            md="9"
                        >
                            <b-row>
                                <b-col
                                    cols="12"
                                    md="12"
                                >
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
                                    v-if="sections.find(e=>(e.id===selectedSection)).link"
                                    cols="12"
                                    md="12"
                                >
                                    <b-row>
                                        <b-col
                                            cols="12"
                                            md="6"
                                        >
                                            <div class="form-label-group">
                                                <b-form-input
                                                    v-model="element.url"
                                                    class="mt-2"
                                                    :placeholder="$t('Url')"
                                                />
                                                <label>{{ $t('Url') }}</label>
                                            </div>
                                        </b-col>
                                        <b-col
                                            cols="12"
                                            md="6"
                                        >
                                            <div>
                                                <label>{{ $t('Page') }}</label>
                                                <v-select
                                                    v-model="element.page_id"
                                                    label="title"
                                                    :reduce="pages => pages.id"
                                                    :options="pages"
                                                />
                                            </div>
                                        </b-col>
                                    </b-row>
                                </b-col>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).icon"
                                    cols="12"
                                    md="6"
                                    class="mt-2 mb-2"
                                >
                                    <label>{{ $t('Pack') }}</label>
                                    <v-select
                                        v-model="element.pack"
                                        :options="['fas','fab','far','feather']"
                                    />
                                    <small
                                        v-if="errors['icon']"
                                        class="text-danger"
                                    >{{ errors['icon'][0] }}</small>
                                </b-col>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).icon"
                                    cols="12"
                                    md="6"
                                    class="mt-2 mb-2"
                                >
                                    <label>Icon</label>
                                    <v-select
                                        v-model="element.icon"
                                        :options="icons[element.pack]"
                                    >
                                        <template #option="option">
                                            <font-awesome-icon
                                                v-if="['fas','fab','far'].includes(element.pack)"
                                                class="text-primary"
                                                :icon="[element.pack, option.label]"
                                            />
                                            <feather-icon
                                                v-else-if="['feather'].includes(element.pack)"
                                                :icon="option.label || 'CircleIcon'"
                                            />
                                            <feather-icon
                                                v-else
                                                icon="CircleIcon"
                                            />
                                            <span> {{ option.label }} </span>
                                        </template>

                                    </v-select>
                                </b-col>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).description"
                                    cols="12"
                                    md="12"
                                >
                                    <div class="form-label-group">
                                        <b-form-textarea
                                            v-model="element.description"
                                            rows="4"
                                            class="mt-2"
                                            :placeholder="$t('Description')"
                                        />
                                        <label>{{ $t('Description') }}</label>
                                    </div>
                                </b-col>
                            </b-row>

                        </b-col>
                        <b-col
                            cols="12"
                            md="3"
                        >
                            <b-row>
                                <b-col
                                    v-if="sections.find(e=>(e.id===selectedSection)).image"
                                    cols="12"
                                    md="12"
                                >
                                    <upload
                                        v-model="element.image_id"
                                        @update-url="SetBackgroundUrl"
                                    />
                                </b-col>
                            </b-row>
                        </b-col>
                    </b-row>
                </b-tab>
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
                                    v-model="element[`title_${el.code}`]"
                                    class="mt-2"
                                    :placeholder="$t('Title')"
                                />
                                <label>{{ $t('Title') }}</label>
                            </div>
                        </b-col>
                        <b-col
                            v-if="sections.find(e=>(e.id===selectedSection)).description"
                            cols="12"
                            md="12"
                        >
                            <div class="form-label-group">
                                <b-form-textarea
                                    v-model="element[`description_${el.code}`]"
                                    rows="4"
                                    class="mt-2"
                                    :placeholder="$t('Description')"
                                />
                                <label>{{ $t('Description') }}</label>
                            </div>
                        </b-col>

                    </b-row>
                </b-tab>
            </b-tabs>
        </b-modal>
        <b-row
            v-for="(section,index) in sections"
            :key="index"
        >
            <b-col cols="12">
                <b-card>
                    <b-row align-h="between">

                        <b-col cols="auto">
                            <b-tabs>
                                <b-tab :title="$t('Section Name')">
                                    <div class="form-label-group">
                                        <b-form-input
                                            v-model="section.name"
                                            class="mt-2"
                                            :placeholder="$t('Section Title')"
                                        />
                                        <label>{{ $t('Section Title') }}</label>
                                    </div>
                                </b-tab>
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
                                                    v-model="section[`name_${el.code}`]"
                                                    class="mt-2"
                                                    :placeholder="$t('Section Name')"
                                                />
                                                <label>{{ $t('Section Name') }}</label>
                                            </div>
                                        </b-col>

                                    </b-row>
                                </b-tab>
                            </b-tabs>
                        </b-col>

                        <b-col
                            cols="auto"
                            class="text-end"
                        >
                            <b-button
                                variant="success"
                                @click="UpdateSection(section)"
                            >
                                {{ $t('update') }}
                            </b-button>
                        </b-col>
                    </b-row>
                    <b-card-text>

                        <draggable
                            :list="section.elements"
                            tag="div"
                            :group="`section-${index}`"
                            class="row draggable-transition"
                        >
                            <b-col
                                v-for="(el,elIndex) in section.elements"
                                :key="elIndex"
                                :cols="section.elements_col"
                            >
                                <b-card
                                    border-variant="warning"
                                    class="my-1 overflow-hidden section-elements-image cursor-move"
                                    :img-src="el.image_url?full_path(el.image_url):full_path('images/menu.png')"
                                    overlay
                                >
                                    <b-row>
                                        <b-col
                                            class="d-flex justify-content-end"
                                            md="12"
                                        >
                                            <a @click="CopyElement(section.id,elIndex)">

                                                <font-awesome-icon
                                                    class="text-warning"
                                                    :icon="['fas', 'copy']"
                                                />
                                            </a>
                                            <a @click="UpdateElement(section.id,elIndex)">
                                                <font-awesome-icon
                                                    class="mx-1 text-success"
                                                    :icon="['fas', 'edit']"
                                                />
                                            </a>
                                            <a @click="DeleteElement(section.id,elIndex)">
                                                <font-awesome-icon
                                                    class="text-primary"
                                                    :icon="['fas', 'trash-alt']"
                                                />
                                            </a>
                                        </b-col>
                                        <b-col
                                            md="12"
                                            class="text-center"
                                        >
                                            <font-awesome-icon
                                                v-if="el.pack"
                                                class="text-primary"
                                                :icon="[el.pack, el.icon]"
                                            />
                                            {{ el.title }}
                                        </b-col>
                                    </b-row>
                                </b-card>
                            </b-col>
                            <b-col
                                v-for="createElIndex in (12-((section.elements.length*section.elements_col)%12))/section.elements_col"
                                :key="createElIndex+'create'"
                                :cols="section.elements_col"
                                class="my-1 text-center"
                            >
                                <b-card border-variant="warning">
                                    <b-button
                                        size="sm"
                                        variant="warning"
                                        @click="CreateNewElement(section)"
                                    >
                                        + {{ $t('Create New Element') }}
                                    </b-button>
                                </b-card>
                            </b-col>
                        </draggable>
                    </b-card-text>
                </b-card>
            </b-col>
        </b-row>

    </b-container>
</template>

<script>

import draggable from 'vuedraggable'
import FontAwesomeIconsList from '@/assets/icons/icons.json'

export default {
    components: {
        draggable,
    },
    data() {
        return {
            sections: [],
            errors: [],
            element: {},
            selectedElement: null,
            selectedSection: null,
            createElementModelStatus: false,
            UpdateElementModelStatus: false,
        }
    },
    computed: {
        icons() {
            return FontAwesomeIconsList
        },
        Elements() {
            return this.$store.getters['section/GetElements']
        },
        pages() {
            return this.$store.getters['page/GetElements']
        },
    },
    created() {
        this.getData()
    },
    methods: {
        SetBackgroundUrl(variable) {
            this.element.image_url = variable
        },
        UpdateElement(section, element) {
            this.element = this.sections.find(e => (e.id === section)).elements[element]
            this.UpdateElementModelStatus = true
            this.selectedSection = section
            this.selectedElement = element
        },
        CloseEdit() {
            this.element = {}
            this.selectedElement = null
            this.selectedSection = null
            this.UpdateElementModelStatus = false
        },
        EditModalAction() {
            this.sections.find(e => (e.id === this.selectedSection)).elements[this.selectedElement] = this.element
            this.selectedSection = null
            this.selectedElement = null
        },

        CreateNewElement(section) {
            this.element = {}
            this.createElementModelStatus = true
            this.selectedSection = section.id
        },
        CloseCreate() {
            this.element = {}
            this.selectedSection = null
            this.createElementModelStatus = false
        },
        CreateModalAction() {
            this.sections.find(e => (e.id === this.selectedSection)).elements.push(this.element)
            this.element = {}
            this.createElementModelStatus = false
            this.selectedSection = null
        },

        DeleteElement(section, element) {
            this.sections.find(el => (el.id === section)).elements.splice(element, 1)
        },
        CopyElement(section, element) {
            this.sections.find(el => (el.id === section)).elements.push(this.sections.find(el => (el.id === section)).elements[element])
        },
        UpdateSection(section) {
            this.$store.dispatch('section/Update', section).then(() => {
                this.getData()
            })
        },
        getData() {
            this.$store.dispatch('section/GetElements').then(() => {
                this.sections = this.Elements
            })
            this.$store.dispatch('page/GetElements')
        },
    },
}
</script>
<style>
.draggable-transition > div {
    transition: all 1s
}
</style>
