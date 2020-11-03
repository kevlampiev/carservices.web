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



const router = new VueRouter({
    mode: 'history',
    routes: appRoutes,
});
//
// Vue.component(
//     'passport-clients',
//     require('./components/passport/Clients.vue').default
// );
//
// Vue.component(
//     'passport-authorized-clients',
//     require('./components/passport/AuthorizedClients.vue').default
// );
//
// Vue.component(
//     'passport-personal-access-tokens',
//     require('./components/passport/PersonalAccessTokens.vue').default
// );

const app = new Vue({
    el: '#app',
    router,
    store,

    components: {App},
    data: ()=>{
        return {
            userMail: '',
            // city: 'Москва',
            // cities: [], //Все возможные города
            // types: [], //Все типы автосервисов
            currentPopUp: ''  //Что вывоится в popUp-window
        }
    },

    mounted() {
        this.$store.dispatch('getCities')
        this.$store.dispatch('getTypes')
        this.userMail=localStorage.getItem('userName')
        let tmpCity=localStorage.getItem('city')
        this.$store.commit('setCity',tmpCity || 'Москва')

    },

});


