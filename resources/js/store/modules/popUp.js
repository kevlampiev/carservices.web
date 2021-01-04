export default {
    namespaced: true,
    state: () => ({
        comp: '',
        header: '',
        data: null
    }),
    mutations: {
        show(state, aData) {
            state.comp = aData.comp
            state.header = aData.header
            state.data = aData.data

        },
        close(state) {
            state.comp = ''
            state.header = ''
        }
    },


}
