<template>
    <div class="services-info-photo-wrapper">
        <h3 class="services-info-photo-title">Фотография</h3>
        <div class="services-info-photo-field">
            <img :src="img_link" alt="">
            <div class="services-info-photo-field-placeholder">
                Щелкните здесь чтобы добавить или изменить фото
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "inputImgViewer",
        props: ['img_link']
    }
</script>

<style scoped>

</style>
