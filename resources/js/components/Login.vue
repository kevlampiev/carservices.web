<template>
    <div class="row">
        <div class="centered-window">
            <div class="form-group">
                <label for="inputEmail">Электронная почта</label>
                <input
                    type="email"
                    class="form-control"
                    v-bind:class="{
                        'is-invalid': error.emailInvalid,
                        'is-valid': error.emailValid
                    }"
                    id="inputEmail"
                    aria-describedby="emailHelp"
                    v-model="form.email"
                    v-on:blur="checkEmail"
                    v-on:focus="updateEmail"
                />
                <!-- <small id="emailHelp" class="form-text text-muted" v-if="error.email.length == 0">We'll never share your email with anyone
                    else.</small>
                <small id="emailHelp" class="form-text text-danger" v-else>{{error.email}}</small> -->
            </div>
            <div class="form-group">
                <label for="inputPassword">Пароль</label>
                <input
                    type="password"
                    class="form-control"
                    id="inputPassword"
                    v-model="form.password"
                />
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="Check" />
                <label class="form-check-label" for="Check"
                    >Запомнить меня</label
                >
            </div>
            <button type="submit" class="btn btn-primary" @click="enterLogin">
                Войти
            </button>
            <button
                type="reset"
                class="btn btn-outline-secondary"
                @click="cancelLogin"
            >
                Отмена
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: () => {
        return {
            form: {
                email: "",
                password: ""
            },
            error: {
                email: "",
                emailInvalid: false,
                emailValid: false
            }
        };
    },
    methods: {
        enterLogin() {
            axios.get("/api/login").then(res => console.log(res.data));
        },

        cancelLogin() {
            this.$router.push("/");
        },

        checkEmail() {
            let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test(this.form.email) == false) {
                // this.error.email = "Введен не корректный email";
                this.error.emailInvalid = true;
            } else {
                this.error.emailValid = true;
            }
            // return (this.error.email, this.error.emailInvalid)
        },

        updateEmail() {
            this.error.email = "";
            this.error.emailInvalid = false;
            this.error.emailValid = false;
        }
    }
};
</script>
