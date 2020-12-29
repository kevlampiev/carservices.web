<template>
    <div class="company-entry">
        <form class="company-entry-form">
            <div class="company-entry-block-wrapper">

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label" for="company-entry-row-input-name">Имя:</label>
                    <input id="company-entry-row-input-name"
                           type="name"
                           v-model.trim="form.name"
                           :class="{'company-entry-block-row-input': true,
                           'invalid-data':
                                  $v.form.email.dirty&&(!$v.form.name.minLength || !$v.form.name.required)
                           }">
                </div>
                <small class="error-notificator"
                       v-if="$v.form.name.dirty && !$v.form.name.minLength ">
                    Минимальное количество символов в имени должно быть {{ 1 }}
                </small>
                <small class="error-notificator"
                       v-if="$v.form.name.dirty && !$v.form.name.required ">
                    Для регистрации необходимо имя
                </small>


                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label" for="company-entry-row-input-email">e-mail:</label>
                    <input id="company-entry-row-input-email"
                           placeholder="email@email.ru"
                           type="email"
                           v-model.trim="form.email"
                           :class="{'company-entry-block-row-input': true,
                           'invalid-data':
                                    $v.form.email.dirty && (!$v.form.email.email || !$v.form.email.required)
                           }">
                </div>
                <small class="error-notificator"
                       v-if="$v.form.email.dirty && !$v.form.email.email ">
                    Введенное значение не является адресом электронной почты
                </small>
                <small class="error-notificator"
                       v-if="$v.form.email.dirty && !$v.form.email.required">
                    адрес электронной почты явялется обязательным для регистрации
                </small>

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label"
                           for="company-entry-row-input-password">Пароль:</label>
                    <input type="password"
                           id="company-entry-row-input-password"
                           v-model.trim="form.password"
                           :class="{'company-entry-block-row-input':true,
                           'invalid-data':
                            !$v.form.password.minLength &&
                                !$v.form.password.required}">
                </div>

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label"
                           for="company-entry-row-input-password">Повторите пароль:</label>
                    <input type="password"
                           :class="{'company-entry-block-row-input':true,
                        'invalid-data':
                                $v.form.repeatPassword.$dirty && (
                                !$v.form.repeatPassword.sameAsPassword ||
                                !$v.form.repeatPassword.required)}"
                           v-model.trim="form.repeatPassword"
                    />
                </div>


                <button id="company-entry-form-button" type="button"
                        @click="registerUser"
                        :class="{'company-entry-block-button':true,
                        'disabled-btn': $v.form.$anyError}"
                >Ok
                </button>
            </div>
        </form>
    </div>
</template>


<script>
import {required, minLength, email, sameAs} from "vuelidate/lib/validators";

export default {
    data: () => {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                repeatPassword: ""
            }
        };
    },
    props: ['close'],
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
            repeatPassword: {
                required,
                sameAsPassword: sameAs("password")
            }
        }
    },
    methods: {
        registerUser() {
            this.$store.dispatch('register', this.form)
            this.close()
        },

        cancelRegistration() {
            this.$router.back();
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
