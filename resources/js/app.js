require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import Vuelidate from "vuelidate";

Vue.use(VueRouter);
Vue.use(Vuelidate);

import App from "./components/App";

import { appRoutes } from "./routes.js";

const router = new VueRouter({
    mode: "history",
    routes: appRoutes
});

Vue.component(
    "passport-clients",
    require("./components/passport/Clients.vue").default
);

Vue.component(
    "passport-authorized-clients",
    require("./components/passport/AuthorizedClients.vue").default
);

Vue.component(
    "passport-personal-access-tokens",
    require("./components/passport/PersonalAccessTokens.vue").default
);

// Vue.use(App)

const app = new Vue({
    el: "#app",
    components: { App },
    data: () => {
        return {
            userMail: '',
            city: 'Москва',
            cities: [], //Все возможные города
            types: [], //Все типы автосервисов
            currentPopUp: ''  //Что вывоится в popUp-window
        }
    },
    router,
    mounted() {
        this.getCities()
        this.getTypes()
        this.userMail=localStorage.getItem('userName')
        let tmpCity=localStorage.getItem('city')
        this.city=tmpCity?tmpCity:'Москва'

    },
    methods: {
        getCities() {
            axios.get('/api/cities')
                .then( res=>{
                    this.cities=res.data
                    //TODO Может придти и обюработанная ошибка. Прописать этот вариант
                })
                .catch(
                    err=>{
                        console.log(err.message)
                        //TODO Прорисовать красивый вывод ошибки
                    }
                )
        },

        getTypes() {
            axios.get('/api/types')
                .then( res=>{
                    this.types=res.data
                    //TODO Может придти и обюработанная ошибка. Прописать этот вариант
                })
                .catch(
                    err=>{
                        console.log(err.message)
                        //TODO Прорисовать красивый вывод ошибки
                    }
                )
        }

    }
});

