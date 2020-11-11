<template>

    <table class="table">
        <thead>
        <tr>
            <th scope="col"><i class="fa fa-arrow-left" aria-hidden="true"></i></th>
            <th scope="col" v-for="(el,index) in dates" >{{ el.format('DD.MM.YYYY') }}<br>{{ el.format('dd') }}</th>
            <th scope="col" @click="dayForward"><i class="fa fa-arrow-right" aria-hidden="true" ></i></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
            </td>
            <td v-for="n in 7">
                <a class="available-time" @click="$parent.makeOrder" v-for="(el,index) in scheduledData[n-1]">
                    {{ Math.trunc(el.work_time)}}:{{ 60*(el.work_time%1)}}
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
            dateStart: moment(),
        }
    },
    props: [
        'scheduleList'
    ],
    methods: {
        dayForward: function () {
            let days=this.dateStart.diff(moment(),'days')
            alert(days)
            if(days<13) {
                this.dateStart=this.dateStart.add(1,'days')
            } else {
            }
        },
        dayBack: function () {

        }
    },

    computed: {
        dates() {
            let tmp=[];
            for (let i = 0; i < 7; i++) {
                tmp.push(moment(this.dateStart).add(i,'days'))
            }
            return tmp
        },
        scheduledData() {
            let tmpArr=[[],[],[],[],[],[],[]]
            this.scheduleList.sort((a,b)=>{
                if (a.work_time<b.work_time) {
                    return -1
                } else if (a.work_time>b.work_time) {
                    return 1
                }
                else return 0
            })
            this.scheduleList.forEach((item,index,array)=>{
                let days=moment(item.work_day)
                    .diff(this.dateStart,'days')
                if (days>=0&&days<7) tmpArr[days].push(item)
            })
            return tmpArr
        }
    },

}
</script>

<style>

</style>
