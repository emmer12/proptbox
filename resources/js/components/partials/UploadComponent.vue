<template>
  <div >
    <ul>
      <li v-for="(file, index) in files" :key="index">{{file.name}} - Error: {{file.error}}, Success: {{file.success}}</li>
    </ul>
    <file-upload
      ref="upload"
      v-model="files"
      :post-action="url"
      @input-file="inputFile"
      @input-filter="inputFilter"
      :multiple="true"
      :drop='true'
    >
    Upload file
    </file-upload>
    <button v-show="!$refs.upload || !$refs.upload.active" @click.prevent="$refs.upload.active = true" type="button">Start upload</button>
    <button v-show="$refs.upload && $refs.upload.active" @click.prevent="$refs.upload.active = false" type="button">Stop upload</button>
  </div>
</template>

<script>
import VueUploadComponent from 'vue-upload-component'
export default {
    components: {
      FileUpload: VueUploadComponent
    },
   data: function () {
    return {
      files: [],
       url: process.env.MIX_API_URL+'listing-file-upload',
    }
  },
  methods: {
    /**
     * Has changed
     * @param  Object|undefined   newFile   Read only
     * @param  Object|undefined   oldFile   Read only
     * @return undefined
     */
    inputFile: function (newFile, oldFile) {
      if (newFile && oldFile && !newFile.active && oldFile.active) {
        // Get response data
        console.log('response', newFile.response)
        if (newFile.xhr) {
          //  Get the response status code
          console.log('status', newFile.xhr.status)
        }
      }
    },
    /**
     * Pretreatment
     * @param  Object|undefined   newFile   Read and write
     * @param  Object|undefined   oldFile   Read only
     * @param  Function           prevent   Prevent changing
     * @return undefined
     */
    inputFilter: function (newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        // Filter non-image file
        if (!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(newFile.name)) {
          return prevent()
        }
      }

      // Create a blob field
      newFile.blob = ''
      let URL = window.URL || window.webkitURL
      if (URL && URL.createObjectURL) {
        newFile.blob = URL.createObjectURL(newFile.file)
      }
    }
}
}
</script>

<style>

</style>