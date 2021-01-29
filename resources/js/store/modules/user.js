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
            //Будь осторожен, если поля userData нет в state, вылезет ошибка и ты будешь над ней долго страдать
            for (let key in userData) state[key] = userData[key];
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
                user.role = 'user'
                user.rememberMe = false
                //не делаем тут rememberToken. Отдельно делаем при логине rememberMe
                commit('setUserData', user)
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.token
            } catch (error) {
                const email=error.response.data.errors.email
                if (email) alert(email);
                  else alert('Неизвестная ошибка сервера');
            }
        },

        autoLogin(context) {
            const token = localStorage.token
            if (!token) return
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

            axios.post('/api/autologin')
                .then(response => {
                    const user = response.data.user
                    user.token = response.data.token
                    user.rememberMe = true
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


        async logout(context) {
            await localStorage.removeItem('token')
            await localStorage.removeItem('email')
            context.commit('setUserData', {
                email: null,
                name: null,
                token: null,
                role: 'user',
                rememberMe: false,
                id: null,
            })

        },

    },

    getters: {
        authorized: state => (state.email) && (state.email !== ''),
    }
}
