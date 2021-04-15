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

            <div class="company-calendar-week-date-wrapper" v-for="(el,index) in dates" :key="el.id">
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
            <div class="company-calendar-time-column extended-slot" v-for="n in 7">
                <div v-for="(el,index) in scheduledData[n-1]" :index="el.id"
                     :class="{'company-calendar-time-block':true,
                              'company-calendar-time-block-off': el.order_id}"
                     @click="editOrder(el)"
                >{{ formatTime(el.work_time) }}
                    <span @click.stop="deleteOrder(el)">
                        &#9746;
                    </span>
                </div>

            </div>

        </div>
        <button
            class="services-info-button-cancel"
            @click.prevent="insertOrder"
        >Новое время в расписании
        </button>
    </div>
</template>


<script>
import moment from 'moment'
import SelectTypeBand from "./SelectTypeBand";

moment.locale('ru')

export default {
    components: {SelectTypeBand},
    methods: {
        dayForward: function () {
            this.$store.commit('currentService/setStartDate', {
                date: moment(this.dateStart).add(1, 'days')
            }, {root: true})
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

        insertOrder() {
            if (this.$store.state.currentService.mode !== 'view') {
                alert(this.$store.state.currentService.mode)
                return
            }

            this.$store.commit('popUp/show', {
                comp: 'timeslotEditor',
                header: 'Доавить время в расписание'
            })
            this.$store.commit('timeslots/setCurrentSlot',
                {
                    id: null,
                    name: this.$store.state.currentService.currentType, //наименование типа сервиса
                    slotDateTime: moment(new Date()).format('YYYY-MM-DDTHH:mm'),
                    service_id: this.$store.state.currentService.commonInfo.id, //к чему относится сервис
                    seivice_type_id: null, //дубль, конечно, но что делать
                    order_id: null
                })
        },

        editOrder(el) {

            if (this.$store.state.currentService.mode !== 'view') return
            if (el.order_id) {
                alert('Нельзя изменить позицию на которую уже есть запись')
                return
            }
            this.$store.commit('popUp/show', {
                comp: 'timeslotEditor',
                header: 'Изменить время расписания'
            })
            this.$store.commit('timeslots/setWryCurrentSlot', el)
        },

        deleteOrder(el) {
            if (el.order_id) return
            if (!confirm('Действительно удалить эту запись?')) return
            this.$store.dispatch('timeslots/delete', el)
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

<style scoped>
.extended-slot {
    width: 80px;
}

</style>
