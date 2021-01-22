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
            state.role=userData.role
            state.rememberMe = userData.rememberMe
            state.id = userData.id
        },

    },

    actions: {
        async login({commit, dispatch}, loginData) {
            axios.post("/api/login", loginData)
                .then(response => {
                    const user = response.data.user;
                    user.token = response.data.token
                        commit('setUserData', user)
                        dispatch('storeUserData', user)
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.token
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
        },

        async register({commit}, userData) {
            try {
                const {data} = await axios.post('/api/register', userData)
                const user = data.user
                user.token = data.token
                user.role='user'
                user.rememberMe=false
                //не делаем тут rememberToken. Отдельно делаем при логине rememberMe
                commit('setUserData', user)
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.token
            } catch ({message}) {
                console.error(message)
            }
        },

        autoLogin(context) {
            const token = localStorage.token
            if (!token) return
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

            axios.post('/api/autologin')
                .then(response => {
                    const user=response.data.user
                    user.token=response.data.token
                    user.rememberMe=true
                    context.commit('setUserData', user)
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.token

                })
                .catch(error => {
                    alert('Все плохо')
                    context.dispatch('logout')
                })

        },

        storeUserData(context, userData) {
            localStorage.token = userData.token
        },

        logout(context) {
            context.commit('setUserData', {
                email: null,
                name: null,
                token: null,
                role: 'user',
                rememberMe: false,
                id: null,
            })
            localStorage.removeItem('token')
            localStorage.removeItem('name')
        },

    },

    getters: {
        authorized: state => (state.email) && (state.email !== ''),
    }
}
