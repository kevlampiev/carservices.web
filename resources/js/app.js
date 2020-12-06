import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import Vuelidate from "vuelidate"

import App from './components/App'
import storeData from "./store/index"
import {appRoutes} from './routes.js'

import './bootstrap'

Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(Vuelidate)

const store = new Vuex.Store(
    storeData
)
const router = new VueRouter({
    mode: 'history',
    routes: appRoutes,
});
const app = new Vue({
    el: '#app',
    router,
    store,

    components: {App},

    mounted() {
        this.$store.dispatch('getCities')
        this.$store.dispatch('getTypes')

        this.userMail = localStorage.getItem('userName')
        let tmpCity = localStorage.getItem('city')
        this.$store.commit('setCity', tmpCity || 'Москва')

    },

});
