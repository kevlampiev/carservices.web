<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    Ваш город {{$root.city}}? <a href="#">Изменить</a>
                </div>

            </div>

            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item" v-for="(el,index) in serviceTypes">
                            <a class="nav-link" href="#">{{el}}</a>
                        </li>
                        <li class="nav-item">
                            <div class="input-group">
                                <input
                                    class="form-control py-2 border-right-0 border-left-0 border-top-0 bg-transparent"
                                    type="search" placeholder="Поиск по названию"
                                    id="example-search-input">
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
                    <div class="carservice-card" v-for="(serv,index) in services">
                        <img
                            :src="serv.photo">
                        <div>
                            <h5>{{serv.name}}</h5>
                            <p>{{serv.address}}</p>
                        </div>
                    </div>
                    <!--                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                    <!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>

            <div>

            </div>
        </div>

        <!--        <div class="col-md-6" style="height: 300px" v-if="showMap">-->
        <!--            <yandex-map :settings="mapSettings" :coords="coords">-->
        <!--                &lt;!&ndash;Markers&ndash;&gt;-->
        <!--            </yandex-map>-->
        <!--        </div>-->


    </div>

</template>


<script>

    import {yandexMap, ymapMarker} from 'vue-yandex-maps'

    let tmpServices = [
        {
            id: 1,
            name: 'Киа-Центр',
            address: 'Москва',
            photo: 'https://avatars.mds.yandex.net/get-altay/938969/2a00000160f20c6194b8920e9c318e1c58d0/XXXL'
        },
        {
            id: 2,
            name: 'Автомир Renault',
            address: 'Барнаул>',
            photo: 'https://avatars.mds.yandex.net/get-altay/2776652/2a00000174e2b9570bdcadf0ae9ca23cfb50/XXXL'
        },

    ]

    let tmpServiceTypes = ['Шиномонтаж', 'Автомойка', 'Автосервис']
    //
    // const settings = {
    //     apiKey: '3c2407f4-58d7-4cae-bde0-62264907a452',
    //     lang: 'ru_RU',
    //     coordorder: 'latlong',
    //     version: '2.1'
    // }
    //

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
        methods: {
            getServiceList(aCity) {
                this.services = tmpServices
                this.city = aCity
                this.serviceTypes = tmpServiceTypes
            }
        },
        mounted() {
            this.showMap = true
            this.getServiceList(this.city)

        },
        components: {yandexMap, ymapMarker}

    }
</script>
