export default {
    state: {
        city: 'Москва',
        cities: [],
        types: []

    },

    actions: {
        getCities(context) {
            axios.get('/api/services/city')
                .then( res=>{
                    // this.cities=res.data
                    context.commit("setCities",res.data)
                    //TODO Может придти и обюработанная ошибка. Прописать этот вариант
                })
                .catch(
                    err=>{
                        console.log(err.message)
                        //TODO Прорисовать красивый вывод ошибки
                    }
                )
        },

        getTypes(context) {
            axios.get('/api/services/type')
                .then( res=>{
                    context.commit('setTypes', res.data)
                    //TODO Может придти и обюработанная ошибка. Прописать этот вариант
                })
                .catch(
                    err=>{
                        console.log(err.message)
                        //TODO Прорисовать красивый вывод ошибки
                    }
                )
        },

    },

    mutations: {
        categories(state,data) {
            return state.category = data
        },
        setCity(state, city) {
            state.city=city
            localStorage.city=city
        },
        setCities(state, cities) {
            state.cities=cities
        },

        setTypes(state, types) {
            state.types=types
        }
    }
}
