export default {
    state: () => ({
        email: null,
        name: null,
        token: null,
        rememberMe: false,
        id: null, //id in Database
    }),
    mutations: {
        setEmail(state, email) {
            state.email= email
        },
        setName(state, name) {
            state.name=name
        },
        setToken(state, token) {
            state.token=token
        },
        setRememberMe(state, rememberMe) {
            state.rememberMe = rememberMe
        },
        setId(state, id) {
            state.id= id
        }

    },

    actions: {
        async login(context, loginData) {
            const {data}=await axios.post("/api/login", loginData)

        },
        register(context) {

        },
        autoLogin(context) {

        },
        logout(context) {

        },
        saveUserData(context) {

        },
    },

    getters: {
        authorized: state => (email) && (email !== ''),
    }
}
