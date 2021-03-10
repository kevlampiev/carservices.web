<template>
    <div>
        <h2 class="company-calendar-title">Дата и время</h2>
        <SelectTypeBand :types="types"
                        :currentType="currentType"
                        @setNewCurrentType="setNewCurrentType"
        ></SelectTypeBand>
        <div class="company-calendar-month">{{ currentMonth }}</div>
        <div class="company-calendar-week-wrapper">
            <img class="company-calendar-week-arrow-back" src="/img/arrow-icon.png" @click="dayBack">
            <img class="company-calendar-week-arrow-forward" src="/img/arrow-icon.png" @click="dayForward">

            <div class="company-calendar-week-date-wrapper" v-for="(el,index) in dates">
                <div :class="{'company-calendar-week-date-number':true,
                                'company-calendar-week-date-number-off': (el.day()==6)||(el.day()==0)}">
                    {{ el.format('dd') }}
                </div>
                <div :class="{'company-calendar-week-date-number':true,
                                'company-calendar-week-date-number-off': (el.day()==6)||(el.day()==0)}">
                    {{ el.format('DD') }}
                </div>
            </div>
        </div>

        <div class="company-calendar-time-wrapper">
            <div class="company-calendar-time-column" v-for="n in 7">
                <div v-for="(el,index) in scheduledData[n-1]" :index="el.id"
                     :class="{'company-calendar-time-block':true,
                              'company-calendar-time-block-off': el.order_id}"
                     @click="!el.order_id?$parent.makeOrder(el):''"
                >
                    {{ formatTime(el.work_time) }}
                </div>
            </div>
        </div>

    </div>
</template>


<script>
import moment from 'moment'
import SelectTypeBand from "./SelectTypeBand";

moment.locale('ru')

export default {
    components: { SelectTypeBand },
    methods: {
        dayForward: function () {
            this.$store.commit('currentService/setStartDate', {
                date: moment(this.dateStart).add(1, 'days')
            },{root: true})
        },

        dayBack: function () {
            this.$store.commit('currentService/setStartDate', {
                date: moment(this.dateStart).add(-1, 'days')
            },
                {root: true}
                )
        },

        formatTime: function (time) {
            let result = Math.trunc(time).toString() + ':'
            let minutes = (60 * (time % 1)).toFixed(0)
            if (minutes < 10) {
                result += '0'
            }
            return (result + minutes)
        },

        setNewCurrentType(newCurrentType) {
            this.$store.commit('currentService/setCurrentType', {name: newCurrentType})
        },

    },

    computed: {
        dates() {
            return this.$store.getters['currentService/scheduleDates']
        },
        types() {
            return this.$store.state.currentService.types
        },
        scheduledData() {
            return this.$store.getters['currentService/schedules']
        },
        dateStart() {
            return this.$store.getters['currentService/startDate']
        },
        currentMonth() {
            return moment(this.$store.getters['currentService/startDate']).format('MMMM')
        },
        currentType() {
            return this.$store.state.currentService.currentType
        },

    },

}
</script>

<style>
</style>
