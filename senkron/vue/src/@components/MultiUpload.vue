<template>
  <div>
    <b-row>
      <b-col cols="12">
        <b-form-file
          ref="file"
          v-model="files"
          accept="image/*"
          multiple="multiple"
          type="file"
          :placeholder="$t('Choose a file or drop it here...')"
          drop-placeholder="Drop file here..."
        />
      </b-col>
      <b-col
        cols="12"
        class="mt-1"
      >
        <b-button
          v-if="files.length>0"
          class="w-100"
          variant="outline-success"
          @click="uploadFile"
        >
          {{ $t('Upload images') }}
        </b-button>
      </b-col>
      <b-col
        cols="12"
      >
        <b-card v-if="value.length>0">
          <h5 class="my-1">
            {{ $t('Uploaded Images') }}
          </h5>
          <b-row>
            <!-- latest photo loop -->
            <b-col
              v-for="(image,index) in value"
              :key="index"
              cols="6"
              class="profile-latest-img my-1 d-flex justify-content-center"
            >
              <div
                class="remove-image"
                @click="deleteImage(index)"
              >
                <font-awesome-icon
                  size="2x"
                  :icon="['fas', 'trash']"
                />
              </div>
              <b-avatar
                size="100px"
                rounded
                :src="full_path(image.url)"
                :alt="image.url"
              />
            </b-col>
            <!-- latest photo loop -->
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>

export default {
  name: 'MultiUpload',
  props: {
    value: {
      default: () => [],
      type: Array,
    },
  },
  data() {
    return {
      file: null,
      files: [],
      errors: [],
    }
  },
  methods: {
    deleteImage(val) {
      this.value.splice(val, 1)
      this.$emit('input', this.value)
    },
    uploadFile() {
      this.errors = []
      if (this.files.length > 0) {
        this.$store.dispatch('upload/uploadMultiImages', this.files).then(response => {
          this.$emit('input', this.value.concat(response.data.images))
          this.files = []
        }).catch(error => {
          this.errors = error.response.data.errors.files
        })
      }
    },
  },
}
</script>
<style lang="scss">
@import '@core/scss/vue/pages/page-profile.scss';
.profile-latest-img .b-avatar{
    min-width:100px;
}
.profile-latest-img {
    display: inline-block;
}
.remove-image svg{
    color: red;
    margin: auto;
}
.remove-image:hover{
    opacity:1;
}
.remove-image{
    transition: opacity 0.5s;
    opacity:0;
    display: flex;
    z-index:999;
    position: absolute;
    background-color: rgba(0, 0, 0, 0.5);
    min-width:100px;
    height:100%;
    text-align: center;
    border-radius:5px;
    //padding-top: 10px;
}
.UploadImageButton {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.UploadImageButton:hover {
    cursor: pointer
}

.UploadImageBorder {
    border: 1px dashed
}
</style>
