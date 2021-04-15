<template>
    <div class="time-slot-inner">
        <form class="company-entry-form">
            <div class="company-entry-block-wrapper">

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="service-type">Тип услуг:</label>
                    <select id="service-type"
                            class="services-info-field-input wide"
                            v-model="timeSlot.name"
                    >
                        <option v-for="type in possibleTypes">{{ type.name }}</option>
                    </select>
                </div>
            </div>

            <div class="company-entry-block-wrapper">

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="datetime">Дата и время:</label>
                    <input id="datetime"
                           type="datetime-local"
                           class="services-info-field-input wide"
                           v-model="timeSlot.slotDateTime"
                    >
                </div>
            </div>


            <button id="ok-button" type="button"
                    class="services-info-button-savechanges"
                    :disabled="false"
                    @click.stop="saveChanges"
                    :class="{'disabled-btn': false}">
                Ok
            </button>

            <button class="services-info-button-cancel" @click.prevent="cancelChanges">
                Отмена
            </button>


        </form>
    </div>
</template>

<script>

    export default {

        computed: {
            timeSlot() {
                return this.$store.state.timeslots.currentSlot
            },

            possibleTypes() {
                return this.$store.state.currentService.types
            },
        },

        methods: {
            saveChanges() {
                let slot = this.$store.getters['timeslots/wryCurrentSlot']
                this.$store.dispatch('timeslots/saveChanges', slot)
            },

            cancelChanges() {
                this.$store.commit('popUp/close')
            },
        },
    }

</script>

<style>
    .time-slot-inner {
        padding: 10px;
        width: 424px;
    }

    .wide {
        width: 100%;
    }
</style>
