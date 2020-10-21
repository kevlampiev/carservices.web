<template>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    Ваш город {{$root.city}}? <a href="#">Изменить</a>
                </div>
            </div>

            <!--            <div class="card">-->
            <!--                <div class="card-body">-->
            <!--                    <nav class="nav" v-for="(el,index) in serviceTypes">-->
            <!--                        <a class="nav-link active" href="#">{{el}}</a>-->
            <!--                    </nav>-->
            <!--                </div>-->
            <!--            </div>-->


            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item" href="#" v-for="(el,index) in serviceTypes">
                            <a class="nav-link">{{el}}</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <ul>
                        <li v-for="(serv,index) in services">
                            <h5>{{serv.name}}</h5>
                            <p>{{serv.address}}</p>
                        </li>
                    </ul>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div>

            </div>
        </div>

        <div class="col-md-6" style="height: 300px">
            <yandex-map :settings="mapSettings" :coords="coords">
                <!--Markers-->
            </yandex-map>
        </div>


    </div>

</template>


<script>

    import { yandexMap, ymapMarker } from 'vue-yandex-maps'

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
            this.getServiceList(this.city)
        },
        components: { yandexMap, ymapMarker }

    }
</script>
