<template>
    <div class="row">
        <div class="modal-dialog-my">
            <div class="modal-content-my">
                <div class="modal-header-my">
                    <button class="close" v-on:click="cancelRegistration">
                        &times;
                    </button>
                    <h4 class="modal-title-my">Register with</h4>
                </div>
                <div class="modal-body">
                    <input
                        type="name"
                        class="form-control"
                        v-bind:class="{
                            'is-invalid': $v.form.name.$error,
                            'is-valid':
                                $v.form.name.minLength && $v.form.name.required
                        }"
                        placeholder="Name"
                        v-model.trim="form.name"
                        v-on:blur="checkName"
                        v-on:focus="$v.form.name.$reset"
                    />
                    <input
                        type="email"
                        class="form-control"
                        v-bind:class="{
                            'is-invalid': $v.form.email.$error,
                            'is-valid':
                                $v.form.email.email && $v.form.email.required
                        }"
                        placeholder="Email"
                        v-model.trim="form.email"
                        v-on:blur="checkEmail"
                        v-on:focus="$v.form.email.$reset"
                    />
                    <input
                        type="password"
                        class="form-control"
                        v-bind:class="{
                            'is-invalid': $v.form.password.$error,
                            'is-valid':
                                $v.form.password.minLength &&
                                $v.form.password.required
                        }"
                        placeholder="Password"
                        v-model.trim="form.password"
                        v-on:blur="checkPassword"
                        v-on:focus="$v.form.password.$reset"
                    />
                    <input
                        type="password"
                        class="form-control"
                        v-bind:class="{
                            'is-invalid': $v.form.repeatPasword.$error,
                            'is-valid':
                                $v.form.repeatPasword.sameAsPassword &&
                                $v.form.repeatPasword.required
                        }"
                        placeholder="Repeat Pasword"
                        v-model.trim="form.repeatPasword"
                        v-on:blur="checkRepeatPassword"
                        v-on:focus="$v.form.repeatPasword.$reset"
                    />
                    <button
                        class="btn btn-default btn-login"
                        v-if="!$v.form.$anyError && !$v.form.$invalid"
                        @click="registerUser"
                    >
                        create an account
                    </button>
                    <button class="btn btn-default btn-login" v-else>
                        create an account
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";

export default {
    data: () => {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                repeatPasword: ""
            }
        };
    },
    validations: {
        form: {
            name: {
                required,
                minLength: minLength(1)
            },
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(8)
            },
            repeatPasword: {
                required,
                sameAsPassword: sameAs("password")
            }
        }
    },
    methods: {
        registerUser() {
            axios
                .post("/api/register", {
                    name: this.form.name,
                    email: this.form.email,
                    password: this.form.password
                })
                .then(res => {
                    this.proceedRegistration(res);
                    this.$router.go(-1);
                })
                .catch(err => console.log(err));
        },

        cancelRegistration() {
            this.$router.back();
        },

        //Функция обработки клиентского токена
        proceedRegistration(response) {
            if (!response.data.token) {
                alert("Поле с токеном отсутствует");
            } else {

                localStorage.userData = response.data.token;
                this.$store.commit('setUserMail',this.form.email)
            }
            console.log(response);
        },
        showRegistrationError(error) {
            alert("Какая-то хрень " + error.toString());
        },

        // Функция для проверки поля Name после :blur
        checkName() {
            if (this.form.name) {
                this.$v.form.name.$model = this.form.name;
            }
        },

        // Функция для проверки поля Email после :blur
        checkEmail() {
            if (this.form.email) {
                this.$v.form.email.$model = this.form.email;
            }
        },

        // Функция для проверки поля Password после :blur
        checkPassword() {
            if (this.form.password) {
                this.$v.form.password.$model = this.form.password;
            }
        },
        // Функция для проверки поля RepeatPasswword после :blur
        checkRepeatPassword() {
            if (this.form.repeatPasword) {
                this.$v.form.repeatPasword.$model = this.form.repeatPasword;
            }
        }
    }
};
</script>

<style scoped>
.modal-content-my {
    position: relative;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #999;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 6px;
    outline: 0;
    -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
}

.modal-header-my {
    min-height: 16.43px;
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
}
.modal-header-my .close {
    margin-top: -2px;
}
.modal-title-my {
    margin: 0;
    line-height: 1.42857143;
}
.close {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: 0.2;
}
h4 {
    font-size: 18px;
}
.modal-body {
    position: relative;
    padding: 15px;
}

input[type="name"],
input[type="email"],
input[type="password"] {
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
    width: 100%;
}

.form-control {
    border-radius: 3px;
    background-color: rgba(0, 0, 0, 0.09);
    box-shadow: 0 1px 0px 0px rgba(0, 0, 0, 0.09) inset;
    color: #333333;
}
.form-control:hover {
    background-color: rgba(0, 0, 0, 0.16);
}
.form-control:focus {
    box-shadow: 0 1px 0 0 rgba(0, 0, 0, 0.04) inset;
    background-color: rgba(0, 0, 0, 0.23);
    color: #333333;
}
.btn-login {
    background-color: #00bbff;
    border-color: #00bbff;
    border-width: 0;
    color: #ffffff;
    display: block;
    margin: 0 auto;
    padding: 15px 50px;
    text-transform: uppercase;
    width: 100%;
    height: 46px;
}

.btn-login:hover {
    background-color: #00a4e4;
    color: #ffffff;
}
.modal-dialog-my {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    /* width: 350px; */
}
/* @media (max-width: 400px) {
  .modal-dialog {
    width: 100%;
  } */
</style>
