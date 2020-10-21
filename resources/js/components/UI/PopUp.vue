<template>
    <div class="centered-window">
        <div @click="closeWindow">
            Закрыть
        </div>
        <component :is="$root.currentPopUp"></component>

    </div>
</template>


<script>
    export default {
        data: () => {
            return {
                serviceTypes: [],
                services: [],
                showMap: false,
                mapSettings: {
                    apiKey: '3c2407f4-58d7-4cae-bde0-62264907a452',
                    lang: 'ru_RU',
                    coordorder: 'latlong',
                    version: '2.1'
                },
                coords: [
                    54.82896654088406,
                    39.831893822753904,
                ],
            }
        },
        components: {
            'cityList': () => import('./CityList.vue')
        },
        methods: {
            closeWindow() {
                this.$root.currentPopUp=''
            }
        }

    }
</script>
