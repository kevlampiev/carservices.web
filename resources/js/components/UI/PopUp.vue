<template>
    <div class="block-div">
        <div class="centered-window popUpWindow">
            <div class="title-block">
                {{ header }}
                <div @click="closeWindow" class="close">
                </div>
            </div>

            <component :is="currentComponent" :close="closeWindow"></component>

        </div>
    </div>
</template>


<script>
export default {
    components: {
        'orderDetails': () => import('./OrderDetails'),
        'cityList': () => import('./CityList'),
        'login': () => import('./LoginComp'),
        'register': () => import('./RegisterComp'),
        'timeslotEditor': () => import('./TimeslotEditor'),
        'FileLoader': () => import('./FileLoader'),
    },
    methods: {
        closeWindow() {
            this.$store.commit('popUp/close')
        }
    },
    computed: {
        currentComponent: function () {
            return this.$store.state.popUp.comp
        },
        header: function () {
            return this.$store.state.popUp.header
        }
    }

}
</script>


<style>

/*закрывает остальные элементы, чтобы пользователь не мог к ним обратиться, а наше окно было
типа модальным*/
.block-div {
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.1);
}

.popUpWindow {
    /*position: relative;*/
    padding: 0;
    box-shadow: 0 0 10px 5px rgba(150, 150, 150, 1);

}

.title-block {
    margin: 5px;
    background-color: #007236;
    color: #fff;
    font-size: 18px;
    width: calc(100% - 10px);
    height: 35px;
    padding: 5px 35px 5px 5px;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
}

.close {
    position: absolute;
    right: 20px;
    top: 10px;
    width: 16px;
    height: 16px;
    opacity: 1;
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
    background-color: #fff;
}

.close:before {
    transform: rotate(45deg);
}

.close:after {
    transform: rotate(-45deg);
}


</style>
