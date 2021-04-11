<template>
    <div>
        <vue-dropzone
            ref="vueDropzone"
            id="dropzone"
            :options="dropzoneOptions"
            v-on:vdropzone-success="okClose"
            v-on:vdropzone-error="cancelClose"
        ></vue-dropzone>
        <hr>
        <button @click="sendToServer">
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
                headers: { "My-Awesome-Header": "header value" },
                autoProcessQueue: false

            }
        }
    },

    methods: {
        sendToServer() {
            this.$refs.vueDropzone.processQueue()
        },

        okClose()  {
            alert('Ok')
            this.$store.commit('popUp/close')
        },

        cancelClose() {
            alert('Error')
            this.$store.commit('popUp/close')
        }
    },

}

</script>

<style>
</style>
