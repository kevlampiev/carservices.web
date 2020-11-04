export default {
    state: {
        city: 'Москва',
        cities: [],
        types: [],
        // userMail: '',
        userData: {
            email: '',
            token: '',
            // rememberMe: false
        }

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
        loadUserData(context) {
            let userData=localStorage.userData
            context.commit('setUserMail', userMail)
        },

        logout(context) {
            context.commit('setUserData', {})
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
        // setUserMail(state, userMail) {
        //     localStorage.removeItem('userName')
        //     localStorage.removeItem('userData')
        //     state.userMail=userMail
        //     if (userMail&&userMail!=='') {
        //         localStorage.userMail=userMail
        //     }
        // },

        setUserData(state, newUserData) {
            if ((newUserData.email!=='')&&(newUserData.token!=='')) {
                // Object.assign(state.userData,newUserData)
                state.userData.email=newUserData.email
                state.userData.token=newUserData.token
            }
        }
    }
}
