<template>
    <div class="time-slot-inner">
        <form class="company-entry-form">
            <div class="company-entry-block-wrapper">

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="service-type">Тип услуг:</label>
                    <select id="service-type"
                            class="services-info-field-input wide">
                        <option>Пункт 1</option>
                        <option>Пункт 2</option>
                    </select>
                </div>
                <small class="error-notificator"
                       v-if="false">
                    Минимальное количество символов в имени должно быть {{ 2 }}
                </small>
                <small class="error-notificator"
                       v-if="true ">
                    Для регистрации необходимо имя
                </small>
            </div>

            <div class="company-entry-block-wrapper">

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="datetime">Дата и время:</label>
                    <input id="datetime"
                           type="datetime-local"
                           class="services-info-field-input wide"
                    >
                </div>
                <small class="error-notificator"
                       v-if="false">
                    Минимальное количество символов в имени должно быть {{ 2 }}
                </small>
                <small class="error-notificator"
                       v-if="true ">
                    Для регистрации необходимо имя
                </small>
            </div>

            <div class="company-entry-block-wrapper">

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="order">Заказ на это время:</label>
                    <input id="order"
                           type="datetime-local"
                           class="services-info-field-input wide"
                    >
                </div>
                <small class="error-notificator"
                       v-if="false">
                    Минимальное количество символов в имени должно быть {{ 2 }}
                </small>
                <small class="error-notificator"
                       v-if="true ">
                    Для регистрации необходимо имя
                </small>
            </div>

        </form>
    </div>
</template>

<script>

export default {

}

</script>

<style>
.time-slot-inner {
    padding: 10px;
    width: 500px;
}

.wide {
    width: 100%;
}
</style>
