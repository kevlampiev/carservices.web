<template>
    <div class="company-entry">
        <form class="company-entry-form">
            <div class="company-entry-block-wrapper">
                <div class="company-entry-block-row-no-grow">
                    <div class="company-entry-block-row-title">Дата и время</div>
                    <div id="company-entry-block-row-date">10–11–2020 17:30</div>
                </div>
                <div class="company-entry-block-row-no-grow">
                    <div class="company-entry-block-row-title">Вид услуги:</div>
                    <div id="company-entry-block-row-services-type">Шиномонтаж</div>
                </div>
                <label class="company-entry-block-textarea-title" for="company-entry-block-textarea">Дополнительная
                    информация: (описание проблемы)
                    <textarea
                        id="company-entry-block-textarea"
                        v-model="orderDetails.description"></textarea>
                </label>
            </div>
            <div class="company-entry-block-divider"></div>
            <div class="company-entry-block-wrapper">
                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label" for="company-entry-row-input-gos-znak">Государственный
                        регистрационный знак:</label>
                    <input id="company-entry-row-input-gos-znak"
                           placeholder="Х000ХХ199"
                           v-model="orderDetails.license_plate_number"
                           :class="{'company-entry-block-row-input': true,
                           'invalid-data':
                                    ($v.orderDetails.license_plate_number.$dirty &&(!$v.orderDetails.license_plate_number.required)|| (!$v.orderDetails.license_plate_number.minLength))
                           }">
                </div>
                <small class="error-notificator"
                       v-if="$v.orderDetails.license_plate_number.$dirty &&!$v.orderDetails.license_plate_number.required">
                    Регистрационный знак должен быть указан
                </small>
                <small class="error-notificator"
                       v-if="$v.orderDetails.license_plate_number.$dirty &&!$v.orderDetails.license_plate_number.minLength">
                    Минимальное количество знаков в регистрационном знаке - {{ gosNumbLngth }}
                </small>

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label" for="company-entry-row-input-model-auto">Модель
                        авто:</label>
                    <input class="company-entry-block-row-input"
                           id="company-entry-row-input-model-auto"
                           placeholder="ГАЗ 2101"
                           v-model="orderDetails.car_model"
                           :class="{'invalid-data': ($v.orderDetails.car_model.$dirty && !$v.orderDetails.car_model.required)}">
                </div>
                <small class="error-notificator"
                       v-if="$v.orderDetails.car_model.$dirty && !$v.orderDetails.car_model.required">
                    Укажите модель автомобиля
                </small>

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label" for="company-entry-row-input-phone">Телефон для
                        связи:</label>
                    <input class="company-entry-block-row-input"
                           id="company-entry-row-input-phone"
                           placeholder="+7 (999) 999-99-99"
                           v-model="orderDetails.telephone"
                           :class="{'invalid-data': ($v.orderDetails.telephone.$dirty && !$v.orderDetails.telephone.validPhone)}">
                </div>
                <small class="error-notificator"
                       v-if="$v.orderDetails.telephone.$dirty && !$v.orderDetails.telephone.validPhone">
                    Укажите корректный номер телефона
                </small>

                <button class="company-entry-block-button" id="company-entry-form-button" type="button"
                        @click="sendOrderToServer">Оформить запись
                </button>
            </div>
        </form>
    </div>
</template>


<script>

import {required, minLength} from "vuelidate/lib/validators";

export default {
    data: () => {
        return {
            orderDetails: {
                user_id: '',
                schedule_id: 1,
                car_model: '',
                license_plate_number: '',
                description: '',
                telephone: '',
                order_status: '',
            }
        }
    },
    validations: {
        orderDetails: {
            car_model: {
                required,
                minLength: minLength(3)
            },
            license_plate_number: {
                required,
                minLength: minLength(8)
            },
            description: {},
            telephone: {
                validPhone: val => {
                    let phoneTmpl = new RegExp('^((8|\\+7)[\\- ]?)?(\\(?\\d{3}\\)?[\\- ]?)?[\\d\\- ]{7,10}$')
                    return phoneTmpl.test(val)
                }
            },

        }
    },
    props: ['close'],
    computed: {
        order_date: function () {
            return this.$store.state.currentService.selectedSchedule.work_day
        },
        order_time: function () {
            return Math.trunc(this.$store.state.currentService.selectedSchedule.work_time) +
                ':' + (60 * (this.$store.state.currentService.selectedSchedule.work_time % 1))
        },
        orderId: function () {
            return this.$store.state.currentService.commonInfo.id
        },
        serviceName: function () {
            return 'Пока не сделано'
        },

        userToken: function () {
            return this.$store.state.userData.token
        },

        gosNumbLngth() {
            return this.$v.orderDetails.license_plate_number.$params.minLength.min
        },
    },
    methods: {
        sendOrderToServer() {

            if (this.$v.$invalid) {
                this.$v.$touch()
                return -1
            }
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.userToken
            axios.post('/api/order', this.orderDetails)
                .then(res => {
                    console.log(res)
                    this.$store.dispatch('getServiceInfo', {
                        id: this.$store.state.currentService.commonInfo.id
                    })
                })
                .catch(err => {
                    console.error(err.message)
                })


            this.close()
        }
    },
    mounted() {
        this.orderDetails.schedule_id = this.$store.state.currentService.selectedSchedule.id
        console.log(this.$store.state.makeOrder.count)
    }
}
</script>
