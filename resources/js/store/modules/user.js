export default {
    state: () => ({
        email: 'usermail',
        name: null,
        token: null,
        rememberMe: false,
        id: null, //id in Database
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
        },

    },

    actions: {
        async login(context, loginData) {
            try {
                const {data} = await axios.post("/api/login", loginData)
                if (data.error) {
                    alert(data.error)
                    return
                }
                context.commit('setUserData', data)
                if (data.rememberMe) {
                    localStorage.token = data.token
                    //TODO Сохранение email - лишний элемент, потом надо будет удалить, как наведем порядок с ответом сервера по автологину
                    localStorage.email = data.email
                }
            } catch ({message}) {
                console.error(message)
            }

        },

        async register(context, userData) {
            try {
                const {data} = await axios.post('/api/register', userData)
                if (data.error) {
                    alert(data.error)
                    return
                }
                //не делаем тут rememberToken. Отдельно делаем при логине rememberMe
                context.commit('setUserData', data)
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
        },

        logout(context) {
            context.commit('setUserData', {
                email: null,
                name: null,
                token: null,
                rememberMe: false,
                id: null,
            })
        },

    },

    getters: {
        authorized: state => (state.email) && (state.email !== ''),
    }
}
