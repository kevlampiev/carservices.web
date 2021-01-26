<template>
    <div class="main-page">
        <header>
            <div class="container">
                <div class="header-logo">CARSERVICES.WEB</div>
                <div class="header-location" @click.stop="startSelectCity">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    {{ city }}
                </div>

                <div class="header-page-link">
                    <router-link :to="{ name: 'home' }">Главная</router-link>
                </div>
                <div class="header-page-link" v-if="role==='owner'">
                    <router-link :to="{ name: 'hello' }">Мои сервисы</router-link>
                </div>
                <div class="header-page-link" v-if="role==='admin'">
                    <a href="/admin">Раздел администратора</a>
                </div>

                <div class="header-acc-wrapper" v-if="!authorized">
                    <div class="header-page-link" @click="register" id="register-link">
                        Зарегистрироваться
                    </div>
                    <div class="header-page-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="header-page-link" @click="login" id="login-link">
                        Войти
                    </div>

                </div>
                <div class="header-acc-wrapper" v-else>
                    <div class="header-acc-reg">
                        <router-link :to="{ name: 'register' }">{{ email }}</router-link>
                    </div>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div class="header-acc-login" @click="logout" id="logout-link">
                        <router-link :to="{name: 'home'}">Выйти</router-link>
                    </div>
                </div>

            </div>
        </header>

        <router-view></router-view>
        <popUp v-if="popUpComponent"></popUp>
    </div>
</template>

<script>
import popUp from './UI/PopUp.vue'


export default {

    methods: {
        logout() {
            this.$store.dispatch('user/logout')
        },

        startSelectCity() {
            this.$store.commit('popUp/show', {
                comp: 'cityList',
                header: 'выбрать город'
            })
        },

        login() {
            this.$store.commit('popUp/show', {
                comp: 'login',
                header: 'Войти'
            })
        },

        register() {
            this.$store.commit('popUp/show', {
                comp: 'register',
                header: 'зарегистрироваться'
            })
        },

    },
    computed: {
        email: function () {
            return this.$store.state.user.email
        },
        popUpComponent: function () {
            return this.$store.state.popUp.comp
        },

        city: function () {
            return this.$store.state.city
        },

        authorized: function () {
            return this.$store.getters['user/authorized']
        },
        role: function () {
            return this.$store.state.user.role
        }

    },

    components: {
        popUp
    }

}
</script>
