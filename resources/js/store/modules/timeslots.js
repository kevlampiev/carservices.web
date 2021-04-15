//------------------------------------------------------------------------------
// Предназначен для просмотра и редактирования информации о конкретном сервисе
// Используется как для простых пользователей, так и для владельцев сервисов
//------------------------------------------------------------------------------
import moment from "moment"
import currentService from "./currentService"
import * as slotsFunc from '../../functions'

export default {
    namespaced: true,
    state: () => ({
        currentSlot: {
            id: null,
            name: "", //наименование типа сервиса
            slotDateTime: null,
            service_id: null, //к чему относится сервис
            seivice_type_id: null, //дубль, конечно, но что делать
            order_id: null
        }
    }),
    mutations: {
        setCurrentSlot(state, slot) {
            state.currentSlot = slot;
        },

        //Для реботы с currentSlot где используется неправильный формат времени: часы целые, а минуты в долях единицы
        setWryCurrentSlot(state, slot) {
            const cdate = new Date(slot.work_day);
            const fullDT = new Date(
                cdate.getFullYear(),
                cdate.getMonth(),
                cdate.getDate(),
                Math.floor(slot.work_time),
                Math.floor(60 * (slot.work_time % 1)),
                0
            );

            state.currentSlot = Object.assign({}, slot)
            state.currentSlot.slotDateTime = moment(fullDT).format('YYYY-MM-DDTHH:mm')
            delete state.currentSlot.work_day
            delete state.currentSlot.work_time
        },

        //делает новый currentTimeSlot
        newCurrentSlot(state, typeName) {
            state.currentSlot = {
                id: null,
                name: typeName, //наименование типа сервиса
                slotDateTime: null,
                service_id: null, //к чему относится сервис
                seivice_type_id: null, //дубль, конечно, но что делать
                order_id: null
            }
        }
    },

    getters: {
        wryCurrentSlot: (state, getters, rootState) => {
            return slotsFunc.slot2WrySlot(state.currentSlot, rootState.currentService.types)
        },

        uniqueSlot: (state, getters, rootState) => {
            const current = getters.wryCurrentSlot
            const ind = rootState.currentService.schedules.findIndex(
                elem => {
                    return (elem.name === current.name) &&
                        (elem.work_day === current.work_day) &&
                        (elem.work_time === current.work_time) &&
                        (elem.id !== current.id)
                }
            )
            return (ind === -1)
        },
    },

    actions: {
        saveChanges({state, dispatch, commit, getters}) {
            if (!getters.uniqueSlot) {
                alert('Такая позитция в расписании уже пристутвует')
                return
            }

            if (!state.currentSlot.id) {
                dispatch("saveInsert");
            } else {
                dispatch("saveEdit");
            }
            commit("popUp/close", null, {root: true});
        },

        saveEdit({state, rootState, getters}) {
            let slot = slotsFunc.slot2WrySlot(state.currentSlot, rootState.currentService.types)
            axios.put('api/timeslots/' + state.currentSlot.id, slot)
                .then(res => {
                    let elIndex =
                        rootState.currentService.schedules.findIndex(
                            item => item.id === getters.wryCurrentSlot.id)
                    res.data.schedule.name = state.currentSlot.name
                    res.data.schedule.work_day = res.data.schedule.work_day.date
                    console.dir(res.data.schedule)
                    rootState.currentService.schedules.splice(elIndex, 1)
                    rootState.currentService.schedules.push(res.data.schedule)
                })
                .catch(err => {
                    console.error(err.message);
                });
        },

        saveInsert({state, rootState, commit, getters}) {
            axios.post('api/timeslots',
                getters.wryCurrentSlot)
                .then(res => {
                    res.data.schedule.name = state.currentSlot.name
                    rootState.currentService.schedules.push(res.data.schedule)
                })
                .catch(err => {
                    console.error(err.message);
                });
        },

        delete({state, rootState}, el) {
            axios.delete('api/timeslots/' + el.id)
                .then(res => {
                    let elIndex =
                        rootState.currentService.schedules.findIndex(
                            item => item.id === el.id)
                    rootState.currentService.schedules.splice(elIndex, 1)
                })
                .catch(err => {
                    console.error(err.message);
                });
        }
    }
};
