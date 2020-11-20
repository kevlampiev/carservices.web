<template>

    <table class="table" >
        <thead>
        <tr>
            <th scope="col" @click="dayBack"><i class="fa fa-arrow-left" aria-hidden="true"></i></th>
            <th scope="col" v-for="(el,index) in dates">{{ el.format('DD.MM.YYYY') }}<br>{{ el.format('dd') }}</th>
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

</template>


<script>
const moment = require('moment')
moment.locale('ru')

export default {
    data() {
        return {
            dateStart: null,
        }
    },
    props: [
        'scheduleList',
        'currentType',
    ],
    methods: {
        dayForward: function () {
            let days = moment(this.dateStart).diff(moment(), 'days')
            if (days < 13) {
                this.dateStart = moment(this.dateStart).add(1, 'days')
                console.log(this.dateStart)
            } else {
            }
        },

        dayBack: function () {
            let days = moment(this.dateStart).diff(moment(), 'days')
            if (days >= 0) {
                this.dateStart = moment(this.dateStart).add(-1, 'days')
            } else {
            }
        },

    },

    computed: {
        dates() {
            let tmp = [];
            for (let i = 0; i < 7; i++) {
                tmp.push(moment(this.dateStart).add(i, 'days'))
            }
            return tmp
        },
        scheduledData() {
            let tmpArr = [[], [], [], [], [], [], []]

            this.scheduleList.forEach((item, index, array) => {
                let days = moment(item.work_day)
                    .diff(this.dateStart, 'days')
                if ((0 <= days) &&
                    (days < 7) &&
                    ((this.currentType === '*') || (this.currentType === item.name))
                ) {
                    tmpArr[days].push(item)
                }
            })
            return tmpArr
        },

    },

    mounted() {

        //TODO Удалить, как только с фронта будут приходить поготовленные данные
        this.scheduleList.sort((a, b) => {
            if (a.work_time < b.work_time) {
                return -1
            } else if (a.work_time > b.work_time) {
                return 1
            } else return 0
        })

        this.dateStart = new Date
        this.dateStart.setHours(0, 0, 0, 0);
    }

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
    text-decoration:line-through;
}

.occupied:hover {
    color: #aaa;
    background-color: transparent;
    text-decoration:line-through;
}


/*.my-order{*/

/*}*/
</style>
