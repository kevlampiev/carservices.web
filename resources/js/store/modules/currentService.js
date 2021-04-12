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
        mode: "view"
    }),
    actions: {
        async getServiceInfo({state, commit}, inpData) {
            try {
                const {data} = await axios.get("/api/services/" + inpData.id);
                let newData = {
                    commonInfo: data.service,
                    schedules: data.schedules,
                    types: data.types,
                    startDate: new Date().setHours(0, 0, 0, 0),
                    selectedSchedule: null,
                    currentType: data.types[0].name ?? ""
                };
                newData.schedules.sort((a, b) => {
                    if (a.work_time < b.work_time) return -1;
                    else {
                        return a.work_time > b.work_time ? 1 : 0;
                    }
                });
                commit("setCurrentService", newData);
            } catch ({message}) {
                console.error(message);
            }
        },

        /**
         * Просто переход в режим редактирования, если есть реальный текущий сервис с id!=Undefined или null
         * @param state
         * @param commit
         */
        enterEditMode({state, commit}) {
            if (state.mode === "view" && state.commonInfo.id >= 0) {
                commit("setMode", "edit");
            }
        },

        /**
         * Выходит из режима редактирования и восстанавливает значения commonInfo из бэкапа
         * @param state
         * @param commit
         */
        cancelEditMode({state, commit, dispatch}) {
            if (state.mode === "edit") {
                commit("restoreCommonInfo");
            } else if (state.mode === "insert") {
                dispatch("owner/cancelInserting", null, {root: true});
            } else {
                console.error(
                    "ERROR: Вызвана команда cancelEditMode из режима " +
                    state.mode
                );
            }
            commit("setMode", "view");
        },

        enterInsertMode({state, commit}) {
            if (state.mode === "view") {
                commit("owner/insertEmptyService", {}, {root: true});
                commit("setMode", "insert");
            }
        },

        async sendServiceChanges({state, commit, rootState}) {
            const serviceInfo = {
                commonInfo: Object.assign({}, state.commonInfo),
                types: state.types
            };
            delete serviceInfo.commonInfo.types;
            delete serviceInfo.commonInfo.schedules;

            // axios.defaults.headers.common['Authorization'] = 'Bearer ' + rootState.user.token
            try {
                let result;
                if (state.mode === "edit") {
                    await axios.put(
                        "/api/owner/services/" + state.commonInfo.id + "/edit",
                        serviceInfo
                    );
                } else if (state.mode === "insert") {
                    //TODO заменить на правильный роут
                    await axios.post("/api/owner/services/add", serviceInfo);
                } else {
                    throw "Попытка сохранить данные на сервер из режима " +
                    state.mode;
                }
                commit("setMode", "view");
            } catch (error) {
                alert(error.message);
            }
        },

        changeTypePosition({state, commit, rootState}, typeData) {
            const ind = state.types.findIndex(
                item => item.name.trim() === typeData.name.trim()
            ); //ищем элемент в уже сформированном массиве
            const typeEl = rootState.types.find(
                item => item.name === typeData.name.trim()
            ); //ищем элемент в массиве, гле есть вся информация
            if (typeData.checked) {
                if (ind < 0)
                    state.types.push({id: typeEl.id, name: typeEl.name});
            } else {
                if (ind > 0) state.types.splice(ind, 1);
            }
            if (state.mode === "view") commit("setMode", "edit");
        }
    },

    getters: {
        startDate: state => state.startDate,

        insertMode: state => state.mode,

        schedules: state => {
            let tmpArr = [[], [], [], [], [], [], []];
            let startD = state.startDate;
            if (!startD) {
                return tmpArr;
            }
            let currentT = state.currentType;
            state.schedules.forEach((item, index, array) => {
                let days = moment(item.work_day).diff(startD, "days");

                if (
                    0 <= days &&
                    days < 7 &&
                    (currentT === "*" || currentT === item.name)
                ) {
                    tmpArr[days].push(item);
                }
            });
            return tmpArr;
        },

        scheduleDates: state => {
            let tmp = [];
            let startD = state.startDate;
            for (let i = 0; i < 7; i++) {
                tmp.push(moment(startD).add(i, "days"));
            }
            return tmp;
        },

        imgChanged: state  => {
            let editCase = (state.mode === 'edit') &&
                (state.currentService.commonInfo.img_link !== state.currentService.backupData.img_link)
            let insertCase = (state.mode === 'insert') && (state.currentService.img_link !== '')
            return editCase || insertCase
        },
    },

    mutations: {
        setCurrentService(state, service) {
            state.commonInfo = service.commonInfo;
            state.selectedSchedule = service.selectedSchedule;
            state.schedules = service.schedules;
            state.types = service.types;
            state.startDate = service.startDate;
            state.currentType = service.currentType;
            state.backupData = {...service};
        },

        /**
         * Особая функция для случая, когда возвращается набор для владельца сервисов
         */
        setOwnerCurrentService(state, service) {
            state.commonInfo = service;
            state.selectedSchedule = null; //?????
            state.schedules = service.schedules;
            state.types = service.types;

            state.startDate = new Date().setHours(0, 0, 0, 0);
            state.currentType = service.types[0] ? service.types[0].name : " ";
            state.backupData.commonInfo = {...service};
            state.backupData.types = service.types.slice();
            if (!service.id) state.mode = "insert"; //Если id == null или undefined это точно про вставку
        },

        /**
         * Устанавливает у ComonInfo новое имя файла
         * @param state
         * @param fname Новое имя файлы
         */
        setFileName(state, fname) {
            state.commonInfo.img_link = fname
        },

        /**
         * Восстанавливает commonInfo из backup при редектировании существующего сервиса
         * @param state
         */
        restoreCommonInfo(state) {
            state.commonInfo = {...state.backupData.commonInfo};
            state.types = state.backupData.types.slice();
        },

        setStartDate(state, newDate) {
            let days = moment(newDate.date).diff(moment(), "days");
            if (days >= 0 && days < 13) {
                state.startDate = newDate.date;
            }
        },

        //смещает StartDate на заданное количество дней
        scrollStartDate(state, data) {
            let days =
                moment(state.startDate).diff(moment(), "days") + data.days;
            if (days >= 0 && days < 13) {
                state.startDate = moment(state.startDate).add(days, "days");
            }
        },

        setCurrentType(state, data) {
            if (data) {
                let type = data.name;
                let types = state.types;
                if (types.find(el => el.name === type)) {
                    state.currentType = type;
                }
            } else {
                state.currentType = "";
            }
        },

        setMode(state, mode) {
            state.mode = mode;
        }
    }
};
