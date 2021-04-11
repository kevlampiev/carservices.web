<template>
    <div>
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
        <hr>
        <button>
            Ok
        </button>
    </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
export default {
    components: {
        vueDropzone: vue2Dropzone
    },
    data: function () {
        return {
            dropzoneOptions: {
                url: '/loadfile',
                thumbnailWidth: 150,
                maxFilesize: 1.0,
                headers: { "My-Awesome-Header": "header value" }
            }
        }
    }

}

</script>

<style>
</style>
