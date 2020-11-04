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

export default {
    props: ['close'],
        methods: {
            setCity(aCity) {
                this.$store.commit('setCity', aCity)
                this.close()
            }
        },
        mounted() {
        }
    }
</script>
