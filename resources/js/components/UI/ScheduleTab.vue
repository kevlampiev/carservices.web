<template>

    <table class="table">
        <thead>
        <tr>
            <th scope="col"><i class="fa fa-arrow-left" aria-hidden="true"></i></th>
            <th scope="col" v-for="(el,index) in dates" >{{ el.format('DD.MM.YYYY') }}<br>{{ el.format('dd') }}</th>
            <th scope="col"><i class="fa fa-arrow-right" aria-hidden="true"></i></th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>

            </td>
            <td>
                <a class="available-time" @click="$parent.makeOrder">14-30</a>
                <a class="available-time" @click="$parent.makeOrder">15-00</a>
                <a class="available-time" @click="$parent.makeOrder">17-00</a>
            </td>
            <td>
                <a class="available-time" @click="$parent.makeOrder">9-00</a>
                <a class="available-time" @click="$parent.makeOrder">10-00</a>

            </td>
            <td>
                <a class="available-time" @click="$parent.makeOrder">9-30</a>
                <a class="available-time" @click="$parent.makeOrder">10-00</a>
                <a class="available-time" @click="$parent.makeOrder">11-00</a>
                <a class="available-time" @click="$parent.makeOrder">12-00</a>
                <a class="available-time" @click="$parent.makeOrder">15-00</a>
            </td>
            <td>
                <a class="available-time" @click="$parent.makeOrder">14-30</a>
                <a class="available-time" @click="$parent.makeOrder">15-00</a>
                <a class="available-time" @click="$parent.makeOrder">17-00</a>
            </td>
            <td>
                <a class="available-time" @click="$parent.makeOrder">14-30</a>
                <a class="available-time" @click="$parent.makeOrder">15-00</a>
                <a class="available-time" @click="$parent.makeOrder">17-00</a>
            </td>
            <td>
                <a class="available-time" @click="$parent.makeOrder">14-30</a>
                <a class="available-time" @click="$parent.makeOrder">15-00</a>
                <a class="available-time" @click="$parent.makeOrder">17-00</a>
            </td>
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
            dateStart: moment(),
        }
    },
    props: [
        'scheduleList'
    ],
    methods: {
        weekForward: function () {

        },
        weekBack: function () {

        }
    },

    computed: {
        dates() {
            let tmp=[];
            for (let i = 0; i < 7; i++) {
                tmp.push(moment(this.dateStart).add(i-1,'days'))
            }
            return tmp
        },
        scheuledData() {
            return []
        }
    },

}
</script>

<style>

</style>
