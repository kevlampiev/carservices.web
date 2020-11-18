<template>
    <div>
        <h3>Оформить запись на сервис</h3>
        <h4>Дата и время</h4>
        <p>{{ order_date }} {{ order_time }}</p>

<!--        <h4>Вид услуг</h4>-->
<!--        <p>{{serviceName}}</p>-->

        <div class="form-group">
            <label for="carModel">Модель автомобиля</label>
            <input type="text" class="form-control" id="carModel" placeholder="ГАЗ 3101" v-model="orderDetails.car_model">
        </div>

        <div class="form-group">
            <label for="licensePlateNumber">Государствыенный регистрационный знак</label>
            <input type="text" class="form-control" id="licensePlateNumber" placeholder="x000XX199" v-model="orderDetails.license_plate_number">
        </div>

        <div class="form-group">
            <label for="description">Дополнительная информация (описание проблемы)</label>
            <textarea class="form-control" id="description" rows="3" v-model="orderDetails.description"></textarea>
        </div>

        <div class="form-group">
            <label for="telephone">Телефон для связи</label>
            <input type="text" class="form-control" id="telephone" placeholder="+7(900)000-0000" v-model="orderDetails.telephone">
        </div>

        <button type="button" class="btn btn-primary" @click="makeOrder">Ok</button>
        <button type="button" class="btn btn-outline-secondary" @click="close">Отмена</button>
    </div>
</template>


<script>

export default {
    data: () => {
        return {
            orderDetails: {
                user_id: '',
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
        order_date: function() {
            return this.$store.state.popUpData.data.work_day
        },
        order_time: function() {
            return Math.trunc(this.$store.state.popUpData.data.work_time)+
                ':'+(60*(this.$store.state.popUpData.data.work_time%1))
        },
        orderId: function() {
            return this.$store.state.popUpData.id
        },
        serviceName: function() {
            return 'Пока не сделано'
        }
    },
    methods: {
        makeOrder() {
            this.$emit('sendOrderToServer',this.orderDetails)
            // this.$parent.sendOrderToServer(this.orderDetails)
            this.close()
        }
    },
    mounted() {
        console.dir(this.$store.state.popUpData.data)
    }
}
</script>
