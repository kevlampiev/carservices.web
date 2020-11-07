<template>
    <div class="block-div">
        <div class="centered-window popUpWindow">
            <div class="title-block">
                Выбор города
                <div @click="closeWindow" class="close">
                </div>
            </div>

            <component :is="$root.currentPopUp" :close="closeWindow"></component>

        </div>
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
        'cityList': () => import('./CityList.vue'),
        'orderDetails': () => import('./OrderDetails'),
    },
    methods: {
        closeWindow() {
            this.$root.currentPopUp = ''
        }
    }

}
</script>


<style>

/*закрывает остальные элементы, чтобы пользователь не мог к ним обратиться, а наше окно было
типа модальным*/
.block-div {
  position: absolute;
    top:0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,0.1);
}

.popUpWindow {
    /*position: relative;*/
    padding: 0;
    box-shadow: 0 0 10px 5px rgba(150, 150, 150, 1);

}

.title-block {
    margin: 5px;
    background-color: #f0f0f0;
    width: calc(100% - 10px);
    height: 30px;
    padding: 5px 35px 5px 5px;
    font-weight: 800;
    text-align: center;
    text-transform: uppercase;
    color: #aaa;
}

.close {
    position: absolute;
    right: 20px;
    top: 10px;
    width: 16px;
    height: 16px;
    opacity: 0.3;
}

.close:hover {
    opacity: 1;
}

.close:before, .close:after {
    position: absolute;
    left: 15px;
    content: ' ';
    height: 16px;
    width: 2px;
    background-color: #333;
}

.close:before {
    transform: rotate(45deg);
}

.close:after {
    transform: rotate(-45deg);
}


</style>
