<template>
    <div>
        <div class="services-info-field-group">
            <label class="services-info-field-label">{{labelText}}</label>
            <input type="text"
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
            <span v-if="message"> {{message}}  </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "serviceInput.vue",
        props: [
            'modalValue',
            'errorMessages',
            'labelText',
            'hasValidationErrors'
        ]
    }
</script>

<style scoped>


</style>
