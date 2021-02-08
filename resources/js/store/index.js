import moment from 'moment'
import currentService from './modules/currentService'
import user from './modules/user'
import popUp from './modules/popUp'
import owner from "./modules/owner";

export default {
    modules: {
        user,
        owner,
        popUp,
        currentService,
    },
    state: {
        city: null,
        cities: [],
        types: [],
    },

    getters: {},


    actions: {
        init({state, dispatch}) {
            dispatch('user/autoLogin')
            state.city = localStorage.city || 'Москва'
        },
        async getCities({commit}) {
            try {
                const {data} = await axios.get('/api/services/cities')
                commit('setCities', data)
            } catch ({message}) {
                console.error(message)
            }
        },
        async getTypes({commit}) {
            try {
                const {data} = await axios.get('/api/services/types')
                data.unshift({name: 'Все'})
                commit('setTypes', data)
            } catch ({message}) {
                console.error(message)
            }
        },


    },

    mutations: {
        categories(state, data) {
            state.category = data
        },
        setCity(state, city) {
            state.city = city
            localStorage.city = city
        },
        setCities(state, cities) {
            state.cities = cities
        },

        setTypes(state, types) {
            state.types = types
        },


    }
}
