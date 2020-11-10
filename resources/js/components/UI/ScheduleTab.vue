<template>

    <div>

    </div>

</template>


<script>
import SearchLine from "./SearchLine";

export default {
    data() {
        return {
            dateStart: null,
        }
    },
    props: [
        'scheduleList'
    ],
    methods: {
        weekForward: function () {

        },
        weekBack: function() {

        }
    },

    mounted() {
        let date= new Date()
        this.dateStart=date.getDate()
    },

    computed: {

    },
}
</script>

<style>

</style>
