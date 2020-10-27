<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    Ваш город {{$root.city}}? <a href="#" @click.stop="startSelectCity">Изменить</a>
                </div>

            </div>

            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Все </a>
                        </li>

                        <li class="nav-item" v-for="(el,index) in serviceTypes">
                            <a class="nav-link" href="#">{{el}}</a>
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
                    <div class="carservice-card" v-for="(carserv,index) in filteredServices">
                        <img
                            :src="carserv.img_link">
                        <div>
                            <h5>{{carserv.name}}</h5>
                            <p>{{carserv.city}}</p>
                            <p>{{carserv.address}}</p>
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
                searchStr: '',
            }
        },
        methods: {
            getServiceList(aCity) {
                if (!aCity) aCity = this.$root.city
                // this.services = tmpServices
                axios.get('/api/changeLocation',
                    {city: this.$root.city}
                ).then(res => {
                    this.services = res.data
                })
                this.serviceTypes = tmpServiceTypes
                console.log('Запросили список')
            },
            startSelectCity() {
                this.$root.currentPopUp = 'cityList'
            }
        },
        computed: {
            filteredServices: function() {
                console.log(this)
                let sString=this.searchStr
                return this.services.filter(
                    (element)=>{
                    if(sString==='') return true
                        else return (element.name.indexOf(sString)>-1)||(element.address.indexOf(sString)>-1)
                })
            },
        },
        mounted() {
            this.showMap = true
            this.getServiceList(this.$root.city)
        },
        watch: {
            '$root.city': 'getServiceList'
        },
        components: {yandexMap, ymapMarker}

    }
</script>
