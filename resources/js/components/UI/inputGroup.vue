<template>
    <div>
        <div class="services-info-field-group">
            <label
                class="services-info-field-label"
                :for="inputName"
            >{{ labelText }}</label>
            <input type="text"
                   :id="inputName"
                   class="services-info-field-input"
                   :class="{
                        'invalid-data': hasValidationErrors
                   }"
                   :value="modalValue"
                   @input="$emit('input',$event.target.value)"
                   @blur="$emit('blur')"
            >
        </div>
        <div class="error-notificator" v-for="(message,index) in errorMessages" :key="index">
            <span v-if="message"> {{ message }}  </span>
        </div>
    </div>
</template>

<script>

export default {
    name: "serviceInput.vue",
    props: {
        modalValue: {
            required: true
        },
        errorMessages: {
            type: Array,
            required: false
        },
        labelText: {
            type: String,
            default: 'Не задано'
        },
        hasValidationErrors: {
            type: Boolean,
            default: false
        },
        inputName: {
            type: String,
            default: 'none' + (new Date()).getMilliseconds().toString(4)
        }

    }
}
</script>

<style scoped>


</style>
