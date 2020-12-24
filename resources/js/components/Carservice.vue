<template>


    <div class="company-wrapper">
        <div class="container">

            <ServiceCommonInfo :description="description"></ServiceCommonInfo>
            <div class="company-calendar">
                <div>
                    <ScheduleTab :currentType="currentType"></ScheduleTab>

                    <div class="company-calendar-subtitle">Виды услуг</div>

                    <!--                    <div class="menu-wrapper">-->
                    <SelectTypeBand :types="types" :currentType="currentType"
                                    @setNewCurrentType="setNewCurrentType"></SelectTypeBand>
                    <!--                    </div>-->
                </div>
            </div>

        </div>
    </div>

</template>


<script>

import SelectTypeBand from "./UI/SelectTypeBand"
import ScheduleTab from "./UI/ScheduleTab"
import ServiceCommonInfo from "./UI/ServiceCommonInfo"

export default {
    data: () => {
        return {
            currentSchedule: {},
            currentScheduleId: null
        }
    },
    components: {SelectTypeBand, ScheduleTab, ServiceCommonInfo},
    computed: {
        types() {
            return this.$store.state.currentService.types
        },
        currentType() {
            return this.$store.state.currentService.currentType
        },
        description() {
            return this.$store.state.currentService.commonInfo
        },

        schedules() {
            return this.$store.state.currentService.schedules
        },

    },
    methods: {
        setNewCurrentType(newCurrentType) {
            this.$store.commit('setCurrentType', {name: newCurrentType})
        },


        makeOrder(el) {
            if (!this.$store.state.userData.email || this.$store.state.userData.email === '') {
                alert('Для записи необходимо авторизоваться')
                return -1
            }
            this.$store.state.currentService.selectedSchedule = el
            this.$store.state.popUpData = {
                comp: 'orderDetails',
                header: 'дополнительная информация для заказа',
            }
        },

    },
    mounted() {
        this.$store.dispatch('getServiceInfo', {id: this.$route.params.id})

    }
}

</script>


<style>
img {
    width: 180px;
    height: 180px;
    float: left;
    margin: 10px 20px 10px 10px;
}

.types-list {
    margin-left: 25px;
}

.types-list li {
    list-style-type: none;
}

</style>
