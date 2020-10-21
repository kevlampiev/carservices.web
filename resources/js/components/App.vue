<template>
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Carservices.web</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">
                        <router-link :to="{ name: 'home' }">Главная</router-link>
                    </a>
                    <a class="nav-item nav-link" href="#">
                        <router-link :to="{ name: 'hello' }">Что-то еще</router-link>
                    </a>
                </div>
            </div>

            <ul class="nav justify-content-end" v-if="$root.userMail===''">
                <li class="nav-item">
                    <a class="nav-item nav-link" href="#">
                        <router-link :to="{ name: 'register' }">Регистрация</router-link>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="#">
                        <router-link :to="{ name: 'login' }">Войти</router-link>
                    </a>
                </li>
            </ul>

            <ul class="nav justify-content-end" v-else>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="#">
                        <router-link :to="{ name: 'register' }">{{$root.userMail}}</router-link>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="#" @click="logout">
                        Выйти
                    </a>
                </li>
            </ul>

        </nav>

<!--        <div @click="showEMail()">-->
<!--            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem ducimus esse et expedita incidunt modi-->
<!--            provident quas sit tempora voluptatum.-->
<!--            {{$root.userMail}}-->
<!--        </div>-->

        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        // mounted() {
        //
        // },
        methods: {
           logout() {
               //Потрясающей глубины метод
               this.$root.userMail=''
               localStorage.removeItem('userName')
               localStorage.removeItem('userData')
           }
        },

        mounted() {
            this.$root.userMail=localStorage.getItem('userName')
        }
    }
</script>
