import moment from 'moment'
import currentService from './modules/currentService'
import user from './modules/user'
import popUp from './modules/popUp'

export default {
    modules: {
        user,
        popUp,
        currentService,
    },
    state: {
        city: localStorage.city || 'Москва',
        cities: [],
        types: [],
    },

    getters: {},


    actions: {
        init({dispatch}) {
            dispatch('user/autoLogin')
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
