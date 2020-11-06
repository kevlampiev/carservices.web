<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    Ваш город {{ $store.state.city }}? <a href="#" @click.stop="startSelectCity">Изменить</a>
                </div>

            </div>

            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="#" @click="currentType='*'"
                               v-bind:class="{active: currentType==='*'}">Все </a>
                        </li>


                        <li class="nav-item" v-for="(el,index) in $store.state.types">
                            <a class="nav-link" href="#" @click="currentType=el.name"
                               v-bind:class="{active: el.name==currentType}">{{ el.name }}</a>
                        </li>
                        <li class="nav-item">
                            <div class="input-group">
                                <input
                                    class="form-control py-2 border-right-0 border-left-0 border-top-0 bg-transparent"
                                    type="search" placeholder="Поиск по названию"
                                    id="example-search-input"
                                    v-model="searchStr">
                                <span class="input-group-append">
                                      <div
                                          class="input-group-text bg-transparent border-right-0 border-left-0 border-top-0">
                                          <i class="fa fa-search"></i>
                                      </div>
                                </span>
                            </div>
                        </li>
                    </ul>

                </div>
                <div class="card-body">
                    <div class="carservice-card" v-for="(carserv,index) in filteredServices" :key="carserv.id"
                         @click="showService(carserv.id)">
                        <img
                            :src="carserv.img_link">
                        <div>
                            <h5>{{ carserv.name }}</h5>
                            <p>{{ carserv.city }}</p>
                            <p>{{ carserv.address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>

            </div>
        </div>

    </div>

</template>


<script>

import {yandexMap, ymapMarker} from 'vue-yandex-maps'
import {tmpServices} from '../tmpData.js'
import {tmpServiceTypes} from "../tmpData.js";
// import {Carservice} from "./Carservice";

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
            currentType: '*'
        }
    },
    methods: {
        getServiceList(aCity) {
            if (!aCity) aCity = this.$store.state.city
            axios.get('/api/services?city=' + aCity,
            ).then(res => {
                this.services = res.data
            })
            this.serviceTypes = tmpServiceTypes
        },
        startSelectCity() {
            this.$root.currentPopUp = 'cityList'
        },

        showService(id) {
            this.$router.push('service')
        }
    },
    computed: {
        filteredServices: function () {
            return this.services.filter(
                (element) => {
                    let matchSearch = (this.searchStr === '') ? true : (element.name.indexOf(this.searchStr) > -1) || (element.address.indexOf(this.searchStr) > -1)
                    let matchType = (this.currentType === '*') ? true : (element.types.findIndex(el => el.name === this.currentType) > -1)
                    return matchSearch && matchType
                })
        },
    },
    mounted() {
        this.showMap = true
        this.getServiceList(this.$store.state.city)
    },
    watch: {
        '$store.state.city': 'getServiceList'
    },
    components: {
        yandexMap,
        ymapMarker,
        // Carservice
    }

}
</script>
