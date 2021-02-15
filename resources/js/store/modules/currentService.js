import moment from "moment";

export default {
    namespaced: true,
    state: () => ({
        commonInfo: {},
        selectedSchedule: {},
        schedules: [],
        types: [],
        startDate: null,
        currentType: null,
    }),
    actions: {
        async getServiceInfo({state, commit}, inpData) {
            try {
                const {data} = await axios.get('/api/services/' + inpData.id)
                let newData = {
                    commonInfo: data.service,
                    schedules: data.schedules,
                    types: data.types,
                    startDate: (new Date()).setHours(0, 0, 0, 0),
                    selectedSchedule: null,
                    currentType: data.types[0].name
                }
                newData.schedules.sort((a, b) => {
                    if (a.work_time < b.work_time) return -1;
                    else {
                        return (a.work_time > b.work_time) ? 1 : 0
                    }
                })
                commit('setCurrentService', newData)
                // commit('setCurrentType', {name: newData.currentType})
            } catch ({message}) {
                console.error(message)
            }
        },

    },

    getters: {
        startDate: state => state.startDate,

        schedules: state => {
            let tmpArr = [[], [], [], [], [], [], []]
            let startD = state.startDate
            if (!startD) {
                return tmpArr
            }
            let currentT = state.currentType
            state.schedules.forEach((item, index, array) => {
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
            let startD = state.startDate
            for (let i = 0; i < 7; i++) {
                tmp.push(
                    moment(startD).add(i, 'days'))
            }
            return tmp
        },

    },

    mutations: {
        setCurrentService(state, service) {
            state.commonInfo = service.commonInfo
            state.selectedSchedule = service.selectedSchedule
            state.schedules = service.schedules
            state.types = service.types
            state.startDate = service.startDate
            state.currentType = service.currentType
        },

        /**
         * Особая функция для случая, когда возвращается набор для владельца сервисов
         */
        setOwnerCurrentService(state, service){
            state.commonInfo=service
            state.selectedSchedule=null //?????
            state.schedules=service.schedules
            state.types=service.types

            state.startDate=(new Date()).setHours(0, 0, 0, 0)
            state.currentType = service.types[0].name

        },

        setStartDate(state, newDate) {
            let days = moment(newDate.date).diff(moment(), 'days')
            if ((days >= 0) && (days < 13)) {
                state.startDate = newDate.date
            }

        },

        //смещает StartDate на заданное количество дней
        scrollStartDate(state, data) {
            let days = moment(state.startDate).diff(moment(), 'days') + data.days
            if ((days >= 0) && (days < 13)) {
                state.startDate = moment(state.startDate).add(days, 'days')
            }
        },

        setCurrentType(state, data) {
            let type = data.name
            let types = state.types
            if (types.find(el => el.name === type)) {
                state.currentType = type
            }
        },

    }
}
