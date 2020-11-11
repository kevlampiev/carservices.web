<template>

    <div class="row">

        <div class="col-md-5 ">
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
            <SelectTypeBand :types="types" :currentType.sync="currentType"
                            @setNewCurrentType="setNewCurrentType"></SelectTypeBand>
<!--            TODO удалить :type_id в компоненте ниже как только придут отформатированные данные от сервера -->
            <ScheduleTab :scheduleList="schedules" :currentType="currentType" :type_id="type_id"></ScheduleTab>

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
            types: [],
            schedules: [],
            currentType: '*',
            type_id: 0, //TODO причесать данные от сервера и удалить этот элемент
        }
    },
    components: {SelectTypeBand, ScheduleTab},
    methods: {
        setNewCurrentType(newCurrentType) {
            this.currentType = newCurrentType
            //TODO код подлежащий удалению, когда с сервера начнут приходить причесанный данные
            if (newCurrentType === '*') this.type_id = 0;
            else {
                let el = this.types.find(
                    (elem) => {
                        return elem.name === newCurrentType
                    }
                )
                this.type_id = el.id
            }
            //TODO Конец кода, подлежащего удалению
        },
        makeOrder() {
            this.$store.state.popUpData = {
                comp: 'orderDetails',
                header: 'дополнительная информация для заказа',
            }
        },
    },
    mounted() {

        axios.get('/api/services/' + this.$route.params.id)
            .then(
                res => {
                    this.description = res.data[0]
                    this.types = this.description.types
                    this.description.types = null
                    this.schedules = this.description.schedules
                    this.description.schedules = null
                }
            ).catch(
            err => {
                console.log(err.message)
            }
        )
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

.available-time {
    display: block;
    width: 70px;
    height: 30px;
    background-color: transparent;
    border: 2px solid #ccc;
    border-radius: 17px;
    margin: 20px;
    text-align: center;
    font-weight: 800;
    color: #555;
}

.available-time:hover {
    background-color: #555;
    color: white;
    text-decoration: none;
}

.types-list {
    margin-left: 25px;
}

.types-list li {
    list-style-type: none;
}

</style>
