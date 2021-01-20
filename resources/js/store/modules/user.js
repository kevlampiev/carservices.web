export default {
    namespaced: true,
    state: () => ({
        email: null,
        name: null,
        token: null,
        rememberMe: false,
        id: null, //id in Database
        role: '',
    }),
    mutations: {
        setEmail(state, email) {
            state.email = email
        },
        setName(state, name) {
            state.name = name
        },
        setToken(state, token) {
            state.token = token
        },
        setRememberMe(state, rememberMe) {
            state.rememberMe = rememberMe
        },
        setId(state, id) {
            state.id = id
        },
        setUserData(state, userData) {
            state.email = userData.email
            state.token = userData.token
            state.name = userData.name
            state.rememberMe = userData.rememberMe
            state.id = userData.id
            console.log(state.token)
        },

    },

    actions: {
        // async login({commit, dispatch}, loginData) {
        async login({commit, dispatch}, loginData) {
            axios.post("/api/login", loginData)
                .then(response => {
                        commit('setUserData', {
                            token: response.data.token,
                            email: loginData.email
                        })
                        if (loginData.rememberMe) {
                            dispatch('storeUserData', {
                                token: response.data.token,
                                email: loginData.email
                            })
                        }
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.token
                        commit('popUp/close', {}, {root: true})
                    }
                )
                .catch(error => {
                        const errCode = error.response.status
                        switch (errCode) {
                            case 422:
                                alert('Данный e-mail не зарегистрирован в системе')
                                break;
                            case 404:
                                alert('Пароль не верен')
                                break;
                            default:
                                alert('Неизвестная ошибка')
                        }
                    }
                )


            // try {
            //
            //     const {data} = await axios.post("/api/login", loginData)
            //
            //     if (data.errors) {
            //         alert(data.errors)
            //         return
            //     }
            //
            //     commit('setUserData', {
            //         token: data.token,
            //         email: loginData.email
            //     })
            //     if (loginData.rememberMe) {
            //         dispatch('storeUserData', {
            //             token: data.token,
            //             email: loginData.email
            //         })
            //     }
            //     axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token
            // } catch ({message}) {
            //     console.error(message)
            // }

        },

        async register({commit}, userData) {
            try {
                const {data} = await axios.post('/api/register', userData)
                if (data.errors) {
                    alert(data.errors)
                    return
                }
                //не делаем тут rememberToken. Отдельно делаем при логине rememberMe
                commit('setUserData', {
                    email: userData.email,
                    token: data.token
                })
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token
            } catch ({message}) {
                console.error(message)
            }
        },

        autoLogin(context) {
            const token = localStorage.token
            //TODO переделать по человечески код ниже
            // Пока полная хрень, должно быть по-другому:
            // 1) получение токена из localStorage
            // 2) отправка токена на сервер,
            // 3) Получкение с сервера всех параметров: name, email, token, rememberMe ....
            // 4) сохранение параметров в state
            // 5) если выставлен rememeberMe, то только токен сохраняется в localStorage
            // 6) если что=-то не так - чистим все (и store и localStorage)
            context.commit('setUserData', {
                email: localStorage.email,
                name: localStorage.name,
                token: localStorage.token,
                rememberMe: true, //ну раз есть что читать, значит true
                id: null,
            })
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.token
        },

        storeUserData(context, userData) {
            localStorage.token = userData.token
            //TODO Сохранение email - лишний элемент, потом надо будет удалить, как наведем порядок с ответом сервера по автологину
            localStorage.email = userData.email
        },

        logout(context) {
            context.commit('setUserData', {
                email: null,
                name: null,
                token: null,
                rememberMe: false,
                id: null,
            })
            localStorage.removeItem('token')
            localStorage.removeItem('name')
            localStorage.removeItem('email')

        },

    },

    getters: {
        authorized: state => (state.email) && (state.email !== ''),
    }
}
