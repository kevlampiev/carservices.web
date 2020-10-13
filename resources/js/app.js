require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
// import axios from 'axios'

Vue.use(VueRouter)
// Vue.use(axios)

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
    components: { App },
    router,
});
