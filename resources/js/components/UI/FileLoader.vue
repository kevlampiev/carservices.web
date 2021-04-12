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
                url: 'api/owner/img_store',
                thumbnailWidth: 150,
                maxFilesize: 1.0,
                headers: { "Authorization": "Bearer " + this.$store.state.user.token},
                autoProcessQueue: false,
            }
        }
    },

    methods: {
        sendToServer() {
            this.dropzoneOptions.headers = { "Authorization": "Bearer " + this.$store.state.user.token}
            this.$refs.vueDropzone.processQueue()
        },

        okClose(file, resonse)  {
            console.dir(resonse)
            if (this.$store.state.currentService.mode === 'view') {
                this.$store.dispatch('currentService/enterEditMode')
            }
            this.$store.commit('currentService/setFileName', resonse.filename)
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
