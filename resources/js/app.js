require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
//
// const settings = {
//     apiKey: '3c2407f4-58d7-4cae-bde0-62264907a452',
//     lang: 'ru_RU',
//     coordorder: 'latlong',
//     version: '2.1'
// }
//
// import YmapPlugin from 'vue-yandex-maps'
//
// Vue.use(YmapPlugin, settings)

import App from './components/App'
import Hello from './components/Hello'
import Home from './components/Home'
import Register from './components/Register'
import Login from './components/Login'



const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },

    ],
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
            currentPopUp: ''
        }
    },
    router,
});


