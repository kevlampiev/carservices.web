<template>
    <div>
        <h3>Оформить запись на сервис</h3>
        <h4>Дата и время</h4>
        <p>19-11-2020 18:45</p>

        <h4>Вид услуг</h4>
        <p>Шиномонтаж</p>

        <div class="form-group">
            <label for="carModel">Модель автомобиля</label>
            <input type="text" class="form-control" id="carModel" placeholder="ГАЗ 3101">
        </div>

        <div class="form-group">
            <label for="licensePlateNumber">Государствыенный регистрационный знак</label>
            <input type="text" class="form-control" id="licensePlateNumber" placeholder="x000XX199">
        </div>

        <div class="form-group">
            <label for="description">Дополнительная информация (описание проблемы)</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="telephone">Телефон для связи</label>
            <input type="text" class="form-control" id="telephone" placeholder="+7(900)000-0000">
        </div>

        <button type="button" class="btn btn-primary" @click="makeOrder">Ok</button>
        <button type="button" class="btn btn-outline-secondary" @click="close">Отмена</button>
    </div>
</template>


<script>

export default {
    props: ['close'],
    methods: {
        makeOrder() {
            alert('как будто сделан заказ')
            this.close()
        }
    },
    mounted() {
    }
}
</script>
