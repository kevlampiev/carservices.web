export default {
    state: {
        city: 'Москва',
        cities: [],
        types: [],
        userMail: ''

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

        //Для перовнаальной загрузки сохраненного userMail
        loadUserMail(context) {
            let userMail=localStorage.userMail
            context.commit('setUserMail', userMail)
        }

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
        },

        //Если пустой userMail-это logout, чистим localStorage
        setUserMail(state, userMail) {
            state.userMail=userMail
            if (userMail&&userMail!=='') {
                localStorage.userMail=userMail
            } else {
                localStorage.removeItem('userName')
                localStorage.removeItem('userData')
            }
        }
    }
}
