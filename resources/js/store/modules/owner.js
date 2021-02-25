export default {
    namespaced: true,
    state: () => ({
        carServiceList: [],

    }),
    mutations: {
        setCarServiceList(state, list) {
            state.carServiceList = list
            // state.currentService = list[0]
        },
    },
    actions: {
        /**
         * Получает все сервисы, управляемые владельцем по токену владельца
         * @param {Object} commit
         * @return void
         */
        getServicesInfo({commit}) {
            axios.get('/api/owner/services')
                .then(response => {
                    //TODO проверить, а вдруг в data не массив
                    commit('setCarServiceList',response.data)
                    commit('currentService/setOwnerCurrentService',response.data[0],{root: true})
                })
                .catch(error => {
                    alert('/api/owner/services/  error!')
                })
        },
        /**
         * Ишет серфис по имени и устанавливает в качестве текущего для просмостра и редактирования владельцем
         * @param commit, service
         */

        findOwnerServiceByName(context, serviceName) {
            const currService = context.state.carServiceList.find(
                item => item.name === serviceName)
            if (currService) {
                context.commit('currentService/setOwnerCurrentService',
                    currService,
                    {root:true})
            }
        },

        insertEmptyService({state, commit}) {
            const currService={
                name: 'z',
                city: '',
                address: '',
                phone: '',
                email: '',
                telegram: '',
                skype: '',
                site: '',
                description: '',
                types: [],
                schedules: [],
            }
            state.carServiceList.push(currService)
            console.dir(state.carServiceList)
            commit('currentService/setOwnerCurrentService',
                currService,
                {root:true})
        },
    },
}
