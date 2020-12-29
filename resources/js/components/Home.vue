<template>
    <div class="main-page">

        <div class="container">
            <div class="menu-wrapper">
                <div class="menu-search">
                    <search-line :searchStr.sync="searchStr"></search-line>
                </div>
                <select-type-band :types="$store.state.types" :currentType.sync="currentType"
                                  @setNewCurrentType="setNewCurrentType"></select-type-band>

            </div>

            <div class="content-wrapper">
                <div class="content-item" v-for="(carserv,index) in filteredServices" :key="carserv.id">
                    <div>
                        <img class="content-item-company-img" :src="carserv.img_link">
                        <div class="content-item-company-wrapper">
                            <div class="content-item-company-name">{{ carserv.name }}</div>
                            <div class="content-item-company-address">
                                {{ carserv.city }}
                                <br>
                                {{ carserv.address }}
                            </div>
                        </div>
                    </div>
                    <div class="content-item-services-wrapper">
                        <div class="content-item-services-type" v-for="(type,index) in carserv.types" :key="index">
                            {{ type.name }}
                        </div>
                    </div>
                    <div class="content-item-deal-wrapper">
                        <div class="content-item-deal-button" @click="showService(carserv.id)">Записаться</div>
                    </div>
                </div>

            </div>
        </div>


    </div>


</template>


<script>

import {yandexMap, ymapMarker} from 'vue-yandex-maps'
import {tmpServiceTypes} from "../tmpData.js";
import SearchLine from "./UI/SearchLine";
import SelectTypeBand from "./UI/SelectTypeBand";

export default {
    data: () => {
        return {
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
            searchStr: '',
            currentType: 'Все'
        }
    },
    methods: {
        async getServiceList(aCity) {
            if (!aCity) aCity = this.$store.state.city
            try {
                const {data} = await axios.get('/api/services?city=' + aCity)
                this.services = data
            } catch ({message}) {
                console.error(message)
            }
            // this.serviceTypes = tmpServiceTypes
        },
        startSelectCity() {
            this.$store.state.popUpData = {
                comp: 'cityList',
                header: 'выбрать город',
            }
        },

        showService(id) {
            this.$router.push('/service/' + id)
        },

        setNewCurrentType(newType) {
            this.currentType = newType
        }
    },
    computed: {
        filteredServices: function () {
            let nSearch = this.searchStr.toUpperCase()
            return this.services.filter(
                (element) => {
                    let nName = element.name.toUpperCase()
                    let nAddress = element.address.toUpperCase()
                    let matchSearch = (nSearch === '') ? true : (nName.indexOf(nSearch) > -1) || (nAddress.indexOf(nSearch) > -1)
                    let matchType = (this.currentType === 'Все') ? true : (element.types.findIndex(el => el.name === this.currentType) > -1)
                    return matchSearch && matchType
                })
        },
        types() {
            return this.$store.state.types
        },
    },
    mounted() {
        this.showMap = true
        this.getServiceList(this.$store.state.city)
        this.$store.state.popUpData.comp = ''
    },
    watch: {
        '$store.state.city': 'getServiceList'
    },
    components: {
        SelectTypeBand,
        SearchLine,
        yandexMap,
        ymapMarker,
    }

}
</script>
