export default {
    state: () => ({
        count: 0
    }),
    mutations: {
        increment(state) {
            // `state` указывает на локальное состояние модуля
            state.count++;
        }
    },

    getters: {
        doubleCount(state) {
            return state.count * 2;
        }
    }
}
