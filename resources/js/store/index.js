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
        city: null,
        cities: [],
        types: [],
        alertText: '',
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
        alertAlert({commit}, payload) {
            commit('setAlertText', payload.alertText)
            setTimeout(()=>{
                commit('setAlertText', '')
            },2000)

        }


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

        setAlertText(state, text) {
            state.alertText=text
        }

    }
}
