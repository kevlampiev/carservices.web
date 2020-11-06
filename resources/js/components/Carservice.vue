<template>

    <div class="row">

        <div class="col-md-5 ">
            <h2>Общая информация</h2>
            <img src="https://lorempixel.com/640/480/?17292" alt="">

            <h4>Название сервиса</h4>

            <h5>Виды оказываемых услуг</h5>
            <ul class="types-list">
                <li>автосервис</li>
                <li>мойка авто</li>
                <li>шиномотраж</li>
            </ul>

            <h5>Контактная информация</h5>
            <p>Москва. Некоторая улица д.15 стр 3</p>
            <p>Тел: Этого поля нет в БД +7(495) 322-2233</p>
            <p>Telegram: Этого поля нет в БД </p>
            <p>Skype: Этого поля нет в БД </p>


            <h5>Описание</h5>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia maxime commodi, qui dignissimos repellat
                ut sapiente voluptatibus architecto voluptatem iure impedit laudantium vel et similique perferendis
                porro. Adipisci, fuga fugit.
            </p>

        </div>

        <div class="col-md-7">
            <h2>Расписание</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><i class="fa fa-arrow-left" aria-hidden="true"></i></th>
                    <th scope="col">Пн. 9/11/20</th>
                    <th scope="col">Вт. 10/11/20</th>
                    <th scope="col">Ср. 11/11/20</th>
                    <th scope="col">Чт. 12/11/20</th>
                    <th scope="col">Пт. 13/11/20</th>
                    <th scope="col">Сб. 14/11/20</th>
                    <th scope="col">Вс. 15/11/20</th>
                    <th scope="col"><i class="fa fa-arrow-right" aria-hidden="true"></i></th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>

                    </td>
                    <td>
                        <a class="available-time" @click="makeOrder">14-30</a>
                        <a class="available-time" @click="makeOrder">15-00</a>
                        <a class="available-time" @click="makeOrder">17-00</a>
                    </td>
                    <td>
                        <a class="available-time" @click="makeOrder">9-00</a>
                        <a class="available-time" @click="makeOrder">10-00</a>

                    </td>
                    <td>
                        <a class="available-time" @click="makeOrder">9-30</a>
                        <a class="available-time" @click="makeOrder">10-00</a>
                        <a class="available-time" @click="makeOrder">11-00</a>
                        <a class="available-time" @click="makeOrder">12-00</a>
                        <a class="available-time" @click="makeOrder">15-00</a>
                    </td>
                    <td>
                        <a class="available-time" @click="makeOrder">14-30</a>
                        <a class="available-time" @click="makeOrder">15-00</a>
                        <a class="available-time" @click="makeOrder">17-00</a>
                    </td>
                    <td>
                        <a class="available-time" @click="makeOrder">14-30</a>
                        <a class="available-time" @click="makeOrder">15-00</a>
                        <a class="available-time" @click="makeOrder">17-00</a>
                    </td>
                    <td>
                        <a class="available-time" @click="makeOrder">14-30</a>
                        <a class="available-time" @click="makeOrder">15-00</a>
                        <a class="available-time" @click="makeOrder">17-00</a>
                    </td>
                    <td>

                    </td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>
</template>


<script>

export default {
    methods: {
        makeOrder() {
            this.$root.currentPopUp = 'orderDetails'
        },
    }
}

</script>


<style>
img {
    width: 180px;
    height: 180px;
    float: left;
    margin: 10px 20px 10px 10px;
}

.available-time {
    display: block;
    width: 70px;
    height: 30px;
    background-color: transparent;
    border: 2px solid #ccc;
    border-radius: 17px;
    margin: 20px;
    text-align: center;
    font-weight: 800;
    color: #555;
}

.available-time:hover {
    background-color: #555;
    color: white;
    text-decoration: none;
}

.types-list {
    margin-left: 25px;
}

.types-list li {
    list-style-type: none;
}

</style>
