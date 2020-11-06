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
                        <router-link :to="{ name: 'hello' }">Раздел хозяина</router-link>
                    </a>
                </div>
            </div>

            <ul class="nav justify-content-end" v-if="!email||email===''">
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
                        <router-link :to="{ name: 'register' }">{{ email }}</router-link>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="#" @click="logout">
                        Выйти
                    </a>
                </li>
            </ul>

        </nav>


        <router-view></router-view>
        <popUp v-if="$root.currentPopUp"></popUp>
    </div>
</template>

<script>
import popUp from './UI/PopUp.vue'


export default {
    methods: {
        logout() {
            //Потрясающей глубины метод
            this.$store.dispatch('logout')
            //      },
        },

    },
    computed: {
        email: function () {
            return this.$store.state.userData.email
        }
    },

    mounted() {
    },
    components: {
        popUp
    }

}
</script>
