<template>
    <div >
        <ul>
            <li v-for="(el,index) in $root.cities" :key="index" @click="setCity(el.city)">
                {{el.city}}
            </li>
        </ul>
    </div>

</template>


<script>

import {tmpCities} from '../../tmpData.js'
console.log(tmpCities)

    export default {
        data: () => {
            return {
                cities: [],
            }
        },
        methods: {
            getCitiesList() {
                return tmpCities
            },
            setCity(aCity) {
                this.$root.city=aCity
                localStorage.city=aCity
                this.$parent.closeWindow()
            }
        },
        mounted() {
            this.cities=this.getCitiesList()
        }

    }
</script>
