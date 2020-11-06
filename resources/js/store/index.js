export default {
    state: {
        city: localStorage.city || 'Москва',
        cities: [],
        types: [],
        userData: {
            email: localStorage.email || '',
            token: localStorage.token || '',
            rememberMe: localStorage.getItem('token') !== null
        }

    },

    actions: {
        getCities(context) {
            axios.get('/api/services/city')
                .then(res => {
                    // this.cities=res.data
                    context.commit("setCities", res.data)
                    //TODO Может придти и обюработанная ошибка. Прописать этот вариант
                })
                .catch(
                    err => {
                        console.log(err.message)
                        //TODO Прорисовать красивый вывод ошибки
                    }
                )
        },

        getTypes(context) {
            axios.get('/api/services/type')
                .then(res => {
                    context.commit('setTypes', res.data)
                    //TODO Может придти и обюработанная ошибка. Прописать этот вариант
                })
                .catch(
                    err => {
                        console.log(err.message)
                        //TODO Прорисовать красивый вывод ошибки
                    }
                )
        },

        logout(context) {
            context.commit('setUserData', {})
        }

    },

    mutations: {
        categories(state, data) {
            return state.category = data
        },
        setCity(state, city) {
            state.city = city
            localStorage.city = city
        },
        setCities(state, cities) {
            state.cities = cities
        },

        setTypes(state, types) {
            state.types = types
        },

        setUserData(state, newUserData) {
            if (newUserData.email && newUserData.token && (newUserData.email !== '') && (newUserData.token !== '')) {
                // Object.assign(state.userData,newUserData)
                state.userData.email = newUserData.email
                state.userData.token = newUserData.token
                state.userData.rememberMe = newUserData.rememberMe
                alert(222)
                if (newUserData.rememberMe) {
                    localStorage.email = newUserData.email
                    localStorage.token = newUserData.token
                }
            } else {
                state.userData = {}
                localStorage.removeItem('email')
                localStorage.removeItem('token')
            }
        }
    }
}
