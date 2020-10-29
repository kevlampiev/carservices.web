require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'

import {appRoutes} from './routes.js'





const router = new VueRouter({
    mode: 'history',
    routes: appRoutes,
});

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

// Vue.use(App)

const app = new Vue({
    el: '#app',
    components: {App},
    data: ()=>{
        return {
            userMail: '',
            city: 'Москва',
            cities: [], //Все возможные города
            types: [], //Все типы автосервисов
            currentPopUp: ''  //Что вывоится в popUp-window
        }
    },
    router,
});


