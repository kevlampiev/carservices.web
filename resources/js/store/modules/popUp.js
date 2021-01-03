export default {
    state: () => ({
        comp: '',
        header: '',
        data: null
    }),
    mutations: {
        showPopUp(state,aData) {
            state.comp=aData.comp
            state.header=aData.header
            state.data=aData.data

        }
    },


}
