//------------------------------------------------------------------------------
// Предназначен для просмотра и редактирования информации о конкретном сервисе
// Используется как для простых пользователей, так и для владельцев сервисов
//------------------------------------------------------------------------------
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
        backupData: {}, //дубль объекта commonInfo специально для случая редактирования этой информации
        mode: 'view'
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
            } catch ({message}) {
                console.error(message)
            }
        },

        /**
         * Просто переход в режим редактирования, если есть реальный текущий сервис с id!=Undefined или null
         * @param state
         * @param commit
         */
        enterEditMode({state,commit}) {
          if (state.mode==='view'&&state.commonInfo.id>=0) {
              commit('setMode','edit')
          }
        },

        /**
         * Выходит из режима редактирования и восстанавливает значения commonInfo из бэкапа
         * @param state
         * @param commit
         */
        cancelEditMode({state, commit}) {
            if (state.mode==='edit') {
                commit('restoreCommonInfo')
                commit('setMode','view')
            }
        },

        /**
         * Выходит из режима редактирования и восстанавливает значения commonInfo из бэкапа
         * @param state
         * @param commit
         */
        leftInsertMode({state, commit}) {
            if (state.mode==='insert') {
                //Запросить Owner поставить новый СГККУ
            }
        },

    },

    getters: {
        startDate: state => state.startDate,

        insertMode: state=>state.mode,

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
            state.backupData = { ...service}
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
            state.backupData.commonInfo = { ...service }
            state.backupData.types =service.types.slice()

        },

        /**
         * Восстанавливает commonInfo из backup
         * @param state
         */
        restoreCommonInfo(state) {
            state.commonInfo = { ...state.backupData.commonInfo }
            console.log('before')
            console.dir(state.types)
            state.types = state.backupData.types.slice()
            console.log('after')
            console.dir(state.types)
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

        setMode(state, mode) {
            state.mode=mode
        },

    }
}
