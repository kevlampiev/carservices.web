<template>
    <div >
        <ul>
            <li v-for="(el,index) in $store.state.cities" :key="index" @click="setCity(el.city)">
                {{el.city}}
            </li>
        </ul>
    </div>

</template>


<script>

//import {tmpCities} from '../../tmpData.js'
//console.log(tmpCities)

    import {tmpCities} from "../../tmpData";

export default {
        // data: () => {
        //     // return {
        //     //     cities: [],
        //     // }
        // },
    props: ['close'],
        methods: {
            // getCitiesList() {
            //     return this.$root.cities
            // },
            setCity(aCity) {
                this.$store.commit('setCity', aCity)
                this.close()
            }
        },
        mounted() {
            // this.cities=this.getCitiesList()
        }

    }
</script>
