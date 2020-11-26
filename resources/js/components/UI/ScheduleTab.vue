<template>
<div>
    <h3>{{currentMonth}}</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" @click="dayBack"><i class="fa fa-arrow-left" aria-hidden="true"></i></th>
            <th scope="col" v-for="(el,index) in dates">{{ el.format('DD') }}<br>{{ el.format('dd') }}</th>
            <th scope="col" @click="dayForward"><i class="fa fa-arrow-right" aria-hidden="true"></i></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
            </td>
            <td v-for="n in 7">
                <a :class="{timeslot: true, available:(!el.order_id), occupied: el.order_id} "
                   @click="!el.order_id?$parent.makeOrder(el):''" v-for="(el,index) in scheduledData[n-1]">
                    {{ Math.trunc(el.work_time) }}:{{ 60 * (el.work_time % 1) }}
                </a>
            </td>
            <td>
            <td>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</template>


<script>
// const moment = require('moment')
import moment from  'moment'
moment.locale('ru')

export default {
    props: [
        'currentType',
    ],
    methods: {
        dayForward: function () {
            this.$store.commit('setStartDate',{
                date: moment(this.dateStart).add(1,'days')
            })
        },

        dayBack: function () {
            this.$store.commit('setStartDate',{
                date: moment(this.dateStart).add(-1,'days')
            })
        },

    },

    computed: {
        dates() {
            return this.$store.getters.scheduleDates
        },
        scheduledData() {
            return this.$store.getters.schedules
        },
        dateStart() {
            return this.$store.getters.startDate
        },
        currentMonth() {
            return moment(this.$store.getters.startDate).format('MMMM')
        },

    },

}
</script>

<style>

.timeslot {
    display: block;
    width: 70px;
    height: 30px;
    border: 2px solid #ccc;
    border-radius: 17px;
    margin: 20px;
    text-align: center;
    font-weight: 800;

}


.available {
    color: #555;
    background-color: #aaa;
}

.available:hover {
    background-color: #555;
    color: white;
    text-decoration: none;
}

.occupied {
    color: #aaa;
    background-color: transparent;
    text-decoration: line-through;
}

.occupied:hover {
    color: #aaa;
    background-color: transparent;
    text-decoration: line-through;
}


/*.my-order{*/

/*}*/
</style>
