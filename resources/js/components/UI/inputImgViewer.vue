<template>
    <div class="services-info-photo-wrapper">
        <h3 class="services-info-photo-title">Фотография</h3>
        <div class="services-info-photo-field" :style="{backgroundImage:'url('+img_link+')'}">
            <img :src="img_link" alt="">
<!--            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" ></vue-dropzone>-->
            <div class="services-info-photo-field-placeholder"
                @click="loadImage">
                Щелкните здесь чтобы добавить или изменить фото

            </div>
        </div>
    </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    name: "inputImgViewer",
    data() {
        return {
            dropzoneOptions: {
                url: '/loadfile',
                thumbnailWidth: 150,
                maxFilesize: 1.0,
                headers: { "My-Awesome-Header": "header value" }
            }
        }
    },
    props: ['img_link'],
    components: {
        vueDropzone: vue2Dropzone
    },
    methods: {
        loadImage() {
            this.$store.commit('popUp/show',
                {
                    comp: 'FileLoader',
                    header: 'загрузить фото'
                })
        },
    }
}
</script>

<style scoped>

.op30 {
    opacity: 30%;
}

</style>
