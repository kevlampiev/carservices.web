require('./bootstrap');

import Vue from 'vue'

//VUE-ROUTER
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import App from './components/App'

import {appRoutes} from './routes.js'


//VUEX
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"

const store = new Vuex.Store(
    storeData
)

//VUELIDATE
import Vuelidate from "vuelidate"
Vue.use(Vuelidate)



const router = new VueRouter({
    mode: 'history',
    routes: appRoutes,
});


const app = new Vue({
    el: '#app',
    router,
    store,

    components: {App},
    data: ()=>{
        return {
            userMail: '',
            currentPopUp: ''  //Что вывоится в popUp-window
        }
    },

    mounted() {
        this.$store.dispatch('getCities')
        this.$store.dispatch('getTypes')
        this.$store.dispatch('loadUserMail')

        this.userMail=localStorage.getItem('userName')
        let tmpCity=localStorage.getItem('city')
        this.$store.commit('setCity',tmpCity || 'Москва')

    },

});
