<template>
    <div class="notificator-box"
         v-if="alertText!==''" @click="close">
        <div class="centered-window shadowed-box notificator-div">
            <div class="notificator-frame">
                <p> {{ alertText }}</p>
            </div>

        </div>

    </div>
</template>

<script>

    export default {

        methods: {
            close() {
                this.$store.dispatch('alertAlert', {alertText: ''})
            }
        },

        computed: {
            alertText() {
                return this.$store.state.alertText
            }
        },

        // mounted() {
        //     setTimeout(()=>{this.$store.state.alertText=''},5000)
        // }

    }

</script>

<style>
    .notificator-box {
        background-color: #000;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 50%;
    }

    .notificator-div {
        opacity: 1;
        padding: 10px;
        border: 1px solid green;
    }

</style>
