<template>
    <div class="company-entry">
        <form class="company-entry-form">
            <div class="company-entry-block-wrapper">
                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label" for="company-entry-row-input-email">E-mail:</label>

                    <input id="company-entry-row-input-email"
                           placeholder="email@email.ru"
                           type="email"
                           @blur="$v.form.email.$touch()"
                           v-model.trim="form.email"
                           class="company-entry-block-row-input"
                           :class="{'invalid-data':
                                    $v.form.email.$dirty && (!$v.form.email.email || !$v.form.email.required)
                           }">
                </div>
                <small class="error-notificator"
                       v-if="!$v.form.email.email && $v.form.email.$dirty">
                    введенное значение не является адресом электронной почты
                </small>
                <small class="error-notificator"
                       v-if="$v.form.email.$dirty && !$v.form.email.required">
                    адрес электронной почты явялется обязательным для регистрации
                </small>


                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label"
                           for="company-entry-row-input-password">Пароль:</label>
                    <input class="company-entry-block-row-input"
                           type="password"
                           id="company-entry-row-input-password"
                           @blur="$v.form.password.$touch()"
                           v-model.trim="form.password"
                           :class="{'invalid-data':
                            $v.form.password.$dirty &&
                            !$v.form.password.minLength &&
                                !$v.form.password.required}">
                </div>
                <small class="error-notificator"
                       v-if="!$v.form.password.required && $v.form.password.$dirty">
                    для входа требуется пароль
                </small>
                <small class="error-notificator"
                       v-if="$v.form.password.$dirty && !$v.form.password.minLength">
                    длина пароля не может быть менее 8 символов
                </small>

                <div class="company-entry-block-row">

                    <label class="label-check">
                        <input type="checkbox" class="checkbox" v-model.trim="form.rememberMe"
                               id="rememberMe">
                        <span></span>
                        Запомнить меня
                    </label>
                </div>


                <button id="Ok-button" type="button" :disabled="$v.form.$anyError"
                        @click="enterLogin"
                        class="company-entry-block-button"
                        :class="{'disabled-btn': $v.form.$anyError}"
                >
                    Ok
                </button>
                <a href="#" @click="callRegisterPr" class="company-entry-link"> Зарегистрироваться </a>
            </div>
        </form>
    </div>
</template>


<script>
import {required, minLength, email} from "vuelidate/lib/validators";

export default {
    data: () => {
        return {
            form: {
                email: "",
                password: "",
                rememberMe: true
            }
        };
    },
    props: ['close'],
    validations: {
        form: {
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(8)
            }
        }
    },
    methods: {
        enterLogin() {
            if (this.$v.form.$anyError) return;
            this.$store.dispatch('user/login', this.form)
            // this.close()
        },

        callRegisterPr() {
            this.$store.commit('popUp/show', {
                comp: 'register',
                header: 'Зарегистрироваться',
            })
        },
    }
};
</script>
