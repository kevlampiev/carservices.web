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
        getServicesInfo({commit, rootState}) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + rootState.user.token.accessToken
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
                id: null,
                name: ' ',
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
            commit('currentService/setOwnerCurrentService',
                currService,
                {root:true})
        },

        cancelInserting({state, commit}) {
            const indOfNew=state.carServiceList.findIndex(el=>!el.id)
            if (indOfNew>=0) state.carServiceList.splice(indOfNew,1)
            if (state.carServiceList.length>0) {
                commit('currentService/setOwnerCurrentService',
                    state.carServiceList[0],
                    {root: true}
                )
            }
        },
    },
}
