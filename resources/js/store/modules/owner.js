export default {
    namespaced: true,
    state: () => ({
        carServiceList: [],
        currentService: null
    }),
    mutations: {
        setCarServiceList(state, list) {
            state.carServiceList = list
            state.currentService = list[0]
        }
    },
    actions: {
        getServicesInfo({commit}) {
            axios.get('/api/owner/services')
                .then(response => {
                    commit('setCarServiceList',response.data)
                })
                .catch(error => {
                    alert('/api/owner/services/  error!')
                })
        },

    },



}
