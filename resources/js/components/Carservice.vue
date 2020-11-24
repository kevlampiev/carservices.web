<template>

    <div class="row" @makeOrder="makeOrder(id)">

        <div class="col-md-5" @sots="alert(33)">
            <h2>Общая информация</h2>
            <img :src="description.img_link" alt="">

            <h4>{{ description.name }}</h4>

            <h5>Виды оказываемых услуг</h5>
            <ul class="types-list" v-for="(type,index) in types" :key="type.id">
                <li>{{ type.name }}</li>
            </ul>

            <h5>Контактная информация</h5>
            <p>{{ description.city }},{{ description.address }}</p>
            <p>Тел: {{ description.phone }}</p>
            <p>Telegram: {{ description.telegram }} </p>
            <p>Skype: {{ description.skype }} </p>

            <h5>Описание</h5>
            <p>
                {{ description.description }}
            </p>

        </div>


        <div class="col-md-7">
            <h2>Расписание</h2>
            <SelectTypeBand :types="types" :currentType="currentType"
                            @setNewCurrentType="setNewCurrentType"></SelectTypeBand>
            <ScheduleTab :currentType="currentType"></ScheduleTab>

        </div>
    </div>
</template>


<script>

import SelectTypeBand from "./UI/SelectTypeBand";
import ScheduleTab from "./UI/ScheduleTab";

export default {
    data: () => {
        return {
            description: {},
            schedules: [],
            // type_id: 0, //TODO причесать данные от сервера и удалить этот элемент
            currentSchedule: {},
            currentScheduleId: null
        }
    },
    components: {SelectTypeBand, ScheduleTab},
    computed: {
        types() {
            return this.$store.state.currentService.types
        },
        currentType() {
            return this.$store.state.currentService.currentType
        },

    },
    methods: {
        setNewCurrentType(newCurrentType) {
            this.$store.commit('setCurrentType',{name: newCurrentType})
        },


        makeOrder(el) {
            this.$store.state.currentService.selectedSchedule=el
            this.$store.state.popUpData = {
                comp: 'orderDetails',
                header: 'дополнительная информация для заказа',
            }
        },
        sendOrderToServer(orderDetails) {
            alert('на месте')
            if (typeof orderDetails !== 'object') {
                console.error('Аргумент, возращенный из компонента OrderDetals не является объектом ')
                alert('Аргумент, возращенный из компонента OrderDetals не является объектом ')
            } else {
                orderDetails.schedule_id = this.currentSchedule.id
                axios.post('/api/makeOrder', orderDetails)
                    .then(res => {
                        alert('ЗАказ успешно добавлен')
                        this.currentSchedule.order_id = res.order_id
                    })
                    .catch(err => {
                        console.error(err.message)
                        alert('Не прошло')
                    })
            }
        }
    },
    mounted() {
        this.$store.dispatch('getServiceInfo',{id: this.$route.params.id})
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
