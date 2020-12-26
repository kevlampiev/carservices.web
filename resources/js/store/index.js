import moment from 'moment'
import makeOrder from './modules/makeOrder'

export default {
    modules: {
        makeOrder
    },
    state: {
        city: localStorage.city || 'Москва',
        cities: [],
        types: [],
        userData: {
            email: localStorage.email || '',
            token: localStorage.token || '',
            rememberMe: localStorage.getItem('token') !== null
        },
        popUpData: {
            comp: '',
            header: '',
            data: null
        },

        currentService: {
            commonInfo: {},
            selectedSchedule: {},
            schedules: [],
            types: [],
            startDate: null,
            currentType: null,
        },

    },

    getters: {
        startDate: state => {
            return state.currentService.startDate
        },

        schedules: state => {
            let tmpArr = [[], [], [], [], [], [], []]
            let startD = state.currentService.startDate
            if (!startD) {
                return tmpArr
            }
            let currentT = state.currentService.currentType
            state.currentService.schedules.forEach((item, index, array) => {
                let days = moment(item.work_day)
                    .diff(startD, 'days')

                if ((0 <= days) &&
                    (days < 7) &&
                    ((currentT === '*') || (currentT === item.name))
                ) {

                    tmpArr[days].push(item)
                }
            })

            return tmpArr
        },

        scheduleDates: state => {
            let tmp = []
            let startD = state.currentService.startDate
            for (let i = 0; i < 7; i++) {
                tmp.push(
                    moment(startD).add(i, 'days'))
            }
            return tmp
        },

    },


    actions: {
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

        async getServiceInfo({state, commit}, inpData) {
            try {
                const {data} = await axios.get('/api/services/' + inpData.id)
                let newData = {
                    commonInfo: data.service,
                    schedules: data.schedules,
                    types: data.types,
                    startDate: (new Date()).setHours(0, 0, 0, 0),
                    selectedSchedule: null,
                    currentType: state.currentService.currentType || data.types[0].name
                }
                newData.schedules.sort((a, b) => {
                    if (a.work_time < b.work_time) return -1;
                    else {
                        return (a.work_time > b.work_time) ? 1 : 0
                    }
                })
                commit('setCurrentService', newData)
                commit('setCurrentType', {name: newData.currentType})
            } catch ({message}) {
                console.error(message)
            }
        },

        logout({commit}) {
            commit('setUserData', {})
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

        setCurrentService(state, service) {
            state.currentService = service
        },

        setStartDate(state, newDate) {
            let days = moment(newDate.date).diff(moment(), 'days')
            if ((days >= 0) && (days < 13)) {
                state.currentService.startDate = newDate.date
            }

        },

        //смещает StartDate на заданное количество дней
        scrollStartDate(state, data) {
            let days = moment(state.currentService.startDate).diff(moment(), 'days') + data.days
            if ((days >= 0) && (days < 13)) {
                state.currentService.startDate = moment(state.currentService.startDate).add(days, 'days')
            }
        },

        setCurrentType(state, data) {
            let type = data.name
            let types = state.currentService.types
            if (types.find(el => el.name === type)) {
                state.currentService.currentType = type
            }
        },

        setUserData(state, newUserData) {
            if (newUserData.email && newUserData.token && (newUserData.email !== '') && (newUserData.token !== '')) {
                // Object.assign(state.userData,newUserData)
                state.userData.email = newUserData.email
                state.userData.token = newUserData.token
                state.userData.rememberMe = newUserData.rememberMe
                // alert(222)
                if (newUserData.rememberMe) {
                    localStorage.email = newUserData.email
                    localStorage.token = newUserData.token
                }
            } else {
                state.userData = {}
                localStorage.removeItem('email')
                localStorage.removeItem('token')
            }
        },

    }
}
