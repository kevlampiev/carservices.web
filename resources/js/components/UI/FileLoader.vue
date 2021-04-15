<template>
    <div>
        <vue-dropzone
            ref="vueDropzone"
            id="dropzone"
            :options="dropzoneOptions"
            v-on:vdropzone-success="okClose"
            v-on:vdropzone-error="cancelClose"
            :useCustomSlot=true
        >
            <div class="dropzone-custom-content">
                <h3 class="dropzone-custom-title">Поместите сюда файл для загрузки</h3>
                <div class="subtitle">...или кликните мышью</div>
            </div>
        </vue-dropzone>
        <hr>
        <button
            @click="sendToServer"
            class="services-info-button-savechanges"
        >
            Ok
        </button>
        <button
            @click="cancelClose"
            class="services-info-button-cancel"
        >
            Отмена
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
                    headers: {"Authorization": "Bearer " + this.$store.state.user.token},
                    autoProcessQueue: false,
                }
            }
        },

        methods: {
            sendToServer() {
                this.dropzoneOptions.headers = {"Authorization": "Bearer " + this.$store.state.user.token}
                this.$refs.vueDropzone.processQueue()
            },

            okClose(file, resonse) {
                if (this.$store.state.currentService.mode === 'view') {
                    this.$store.dispatch('currentService/enterEditMode')
                }
                this.$store.commit('currentService/setFileName', resonse.filename)
                this.$store.commit('popUp/close')
            },

            cancelClose() {
                this.$store.commit('popUp/close')
            }
        },

    }

</script>

<style scoped>

    .dropzone-custom-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .dropzone-custom-title {
        margin-top: 0;
        color: green;
    }

    .subtitle {
        color: #314b5f;
    }
</style>
