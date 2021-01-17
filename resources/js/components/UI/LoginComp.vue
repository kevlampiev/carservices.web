<template>
    <div class="company-entry">
        <form class="company-entry-form">
            <div class="company-entry-block-wrapper">
                <div class="company-entry-block-row">
                    <label class="company-entry-block-row-label" for="company-entry-row-input-email">E-mail:</label>

                    <input id="company-entry-row-input-email"
                           placeholder="email@email.ru"
                           type="email"
                           v-model.trim="form.email"
                           :class="{'company-entry-block-row-input': true,
                           'invalid-data':
                                    $v.form.email.dirty && !$v.form.email.email && !$v.form.email.required
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
                    <input class="company-entry-block-row-input"
                           type="password"
                           id="company-entry-row-input-password"
                           v-model.trim="form.password"
                           :class="{'invalid-data':
                            !$v.form.password.minLength &&
                                !$v.form.password.required}">
                </div>


                <div class="company-entry-block-row">

                    <label class="label-check">
                        <input type="checkbox" class="checkbox" v-model.trim="form.rememberMe">
                        <span></span>
                        Запомнить меня
                    </label>
                </div>


                <button id="company-entry-form-button" type="button"
                        @click="enterLogin"
                        :class="{'company-entry-block-button':true,
                        'disabled-btn': $v.form.$anyError}"
                >Ok
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
            this.close()
        },

        checkEmail() {
            if (this.form.email) {
                this.$v.form.email.$model = this.form.email;
            }
        },

        checkPasswword() {
            if (this.form.password) {
                this.$v.form.password.$model = this.form.password;
            }
        },

        callRegisterPr() {
            this.$store.state.popUpData = {
                comp: 'register',
                header: 'Зарегистрироваться',
            }
        },
    }
};
</script>

<style>
/*label input[type=checkbox] {*/
/*    display: none; !* <--скрываем дефолтный чекбокс *!*/
/*}*/

/*label span { !* <-- стилизируем новый *!*/
/*    height: 12px;*/
/*    width: 12px;*/
/*    border: 1px solid gray;*/
/*    display: inline-block;*/
/*    position: relative;*/
/*    background-color: #FFF;*/
/*    border-radius: 2px;*/
/*    padding: 3px;*/
/*}*/

/*[type=checkbox]:checked + span:before { !* <-- ставим иконку, когда чекбокс включен  *!*/
/*    content: '\2714';*/
/*    position: absolute;*/
/*    top: -15px;*/
/*    left: 0;*/
/*    font-size: 23px;*/
/*    color: green;*/
/*}*/
</style>
