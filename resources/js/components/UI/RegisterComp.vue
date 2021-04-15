<template>
    <div class="company-entry">
        <form class="company-entry-form">
            <div class="company-entry-block-wrapper">

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="company-entry-row-input-name">Имя:</label>
                    <input id="company-entry-row-input-name"
                           type="name"
                           v-model.trim="form.name"
                           @blur="$v.form.name.$touch()"
                           class="company-entry-block-row-input"
                           :class="{ 'invalid-data':
                                  $v.form.email.$dirty&&(!$v.form.name.minLength || !$v.form.name.required)
                           }">
                </div>
                <small class="error-notificator"
                       v-if="$v.form.name.$dirty && !$v.form.name.minLength ">
                    Минимальное количество символов в имени должно быть {{ 2 }}
                </small>
                <small class="error-notificator"
                       v-if="$v.form.name.$dirty && !$v.form.name.required ">
                    Для регистрации необходимо имя
                </small>


                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="company-entry-row-input-email">e-mail:</label>
                    <input id="company-entry-row-input-email"
                           placeholder="email@email.ru"
                           type="email"
                           @blur="$v.form.email.$touch()"
                           v-model.trim="form.email"
                           class="company-entry-block-row-input"
                           :class="{'invalid-data':
                                    $v.form.email.$dirty && (!$v.form.email.email || !$v.form.email.required)
                           }"
                    >
                </div>
                <small class="error-notificator"
                       v-if="$v.form.email.$dirty && !$v.form.email.email ">
                    Введенное значение не является адресом электронной почты
                </small>
                <small class="error-notificator"
                       v-if="$v.form.email.$dirty && !$v.form.email.required">
                    адрес электронной почты явялется обязательным для регистрации
                </small>

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="company-entry-row-input-password">Пароль:</label>
                    <input type="password"
                           id="company-entry-row-input-password"
                           v-model.trim="form.password"
                           @blur="$v.form.password.$touch()"
                           class="company-entry-block-row-input"
                           :class="{'invalid-data':
                            $v.form.password.$dirty &&
                            (!$v.form.password.minLength ||
                                !$v.form.password.required)}">

                </div>
                <small class="error-notificator"
                       v-if="$v.form.password.$dirty && !$v.form.password.required">
                    задайте пароль длиной не менее {{ 8 }} символов
                </small>
                <small class="error-notificator"
                       v-if="$v.form.password.$dirty && !$v.form.password.minLength">
                    длина пароля должна быть не менее {{ 8 }} символов
                </small>

                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label  full-width"
                           for="company-entry-row-input-repassword">Повторите пароль:</label>
                    <input type="password"
                           id="company-entry-row-input-repassword"
                           @blur="$v.form.repeatPassword.$touch()"
                           class="company-entry-block-row-input"
                           :class="{'invalid-data':
                            $v.form.repeatPassword.$dirty &&
                            !$v.form.repeatPassword.sameAsPassword}"
                           v-model.trim="form.repeatPassword"
                    />
                </div>
                <small class="error-notificator full-width"
                       v-if="$v.form.repeatPassword.$dirty && !$v.form.repeatPassword.sameAsPassword">
                    введенные пароли не совпадают
                </small>
                <br>


                <button id="ok-button" type="button" :disabled="$v.form.$anyError"
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
                    minLength: minLength(2)
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
                if (this.$v.form.$anyError || !this.$v.form.repeatPassword.sameAsPassword) return;
                this.$store.dispatch('user/register', this.form)
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
