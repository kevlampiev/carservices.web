export default {
    namespaced: true,
    state: () => ({
        carServiceList: [],
        currentService: {
            id:null,
            name: null
        }
    }),
    mutations: {
        setCarServiceList(state, list) {
            state.carServiceList = list
            state.currentService = list[0]
        },

        setCurrentServiceByName(state, serviceName) {
            state.currentService = state.carServiceList.find(
                item => item.name === serviceName)
        },
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
