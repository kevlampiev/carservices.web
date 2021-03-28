//------------------------------------------------------------------------------
// Предназначен для просмотра и редактирования информации о конкретном сервисе
// Используется как для простых пользователей, так и для владельцев сервисов
//------------------------------------------------------------------------------
import moment from "moment";
import currentService from "./currentService";

export default {
    namespaced: true,
    state: () => ({
        currentSlot: {
            id: null,
            name: '', //наименование типа сервиса
            slotDateTime: null,
            service_id: null, //к чему относится сервис
            seivice_type_id: null, //дубль, конечно, но что делать
            order_id: null
        }
    }),
    mutations: {
        setCurrentSlot(state, slot) {
            state.currentSlot = slot
        },

        //Для реботы с currentSlot где используется неправильный формат времени: часы целые, а минуты в долях единицы
        setWryCurrentSlot(state, slot) {
            const cdate = new Date(slot.work_day)
            const fullDT = new Date(
                cdate.getFullYear(),
                cdate.getMonth(),
                cdate.getDate(),
                Math.floor(slot.work_time),
                Math.floor(60 * (slot.work_time % 1)),
                0)

            state.currentSlot = Object.assign({}, slot)
            state.currentSlot.slotDateTime = moment(fullDT).format('YYYY-MM-DDTHH:mm')
            delete state.currentSlot.work_day
            delete state.currentSlot.work_time
        },
    },

    getters: {
        wryCurrentSlot: (state, rootState) => {
            const cdate = new Date(state.currentSlot.slotDateTime)
            const typeObj = rootState.types.find(el => el.name === state.currentSlot.name)
            let result = Object.assign({}, state.currentSlot)
                result.work_day = cdate.toDateString()
                result.work_time = cdate.getHours() + cdate.getMinutes() / 60
                result.service_type_id = typeObj.id
                delete result.slotDateTime
            return result
        }
    },

    actions: {
        saveChanges({state, dispatch, commit}, id) {
            if (!state.currentSlot.id) {
                dispatch('saveInsert')
            } else {
                dispatch('saveEdit')
            }
            commit('popUp/close', null, {root: true})
        },

        saveEdit({state, rootState, getters}) {
            axios.put('api/timeslots/' + state.currentSlot.id + '/edit',
                getters.wryCurrentSlot)
                .then(res => {
                    let arrSlot = rootState.currentService.schedules.find(item =>
                        item.id === getters.wryCurrentSlot.id
                    )
                    arrSlot = getters.wryCurrentSlot
                    console.log(res)
                })
                .catch(err => {
                    console.error(err.message)
                })
        },

        saveInsert() {
            axios.post('api/timeslots/add',
                getters.wryCurrentSlot)
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.error(err.message)
                })
        }

    },

}
