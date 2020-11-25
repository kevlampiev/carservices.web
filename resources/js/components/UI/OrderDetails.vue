<template>
    <div>
        <h3>Оформить запись на сервис</h3>
        <h4>Дата и время</h4>
        <p>{{ order_date }} {{ order_time }}</p>

        <div class="form-group">
            <label for="carModel">Модель автомобиля</label>
            <input type="text" class="form-control" id="carModel" placeholder="ГАЗ 3101"
                   v-model="orderDetails.car_model">
        </div>

        <div class="form-group">
            <label for="licensePlateNumber">Государствыенный регистрационный знак</label>
            <input type="text" class="form-control" id="licensePlateNumber" placeholder="x000XX199"
                   v-model="orderDetails.license_plate_number">
        </div>

        <div class="form-group">
            <label for="description">Дополнительная информация (описание проблемы)</label>
            <textarea class="form-control" id="description" rows="3" v-model="orderDetails.description"></textarea>
        </div>

        <div class="form-group">
            <label for="telephone">Телефон для связи</label>
            <input type="text" class="form-control" id="telephone" placeholder="+7(900)000-0000"
                   v-model="orderDetails.telephone">
        </div>

        <button type="button" class="btn btn-primary" @click="sendOrderToServer">Ok</button>
        <button type="button" class="btn btn-outline-secondary" @click="close">Отмена</button>
    </div>
</template>


<script>

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

        userToken: function() {
            return this.$store.state.userData.token
        },
    },
    methods: {
        sendOrderToServer() {
            axios.defaults.headers.common['Authorization']=this.userToken
            axios.post('/api/order', this.orderDetails)
                .then(res => {
                    console.log(res)
                    this.$store.dispatch('getServiceInfo',{
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
        this.orderDetails.schedule_id=this.$store.state.currentService.selectedSchedule.id
    }
}
</script>
