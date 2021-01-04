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
                    <label class="checkbox-ios">
                        Запомнить меня
                        <input type="checkbox" v-model.trim="form.rememberMe">
                        <span class="checkbox-ios-switch"></span>
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

.checkbox-ios {
    display: inline-block;
    height: 28px;
    line-height: 28px;
    margin-right: 10px;
    position: relative;
    vertical-align: middle;
    font-size: 14px;
    user-select: none;
}

.checkbox-ios .checkbox-ios-switch {
    position: relative;
    display: inline-block;
    box-sizing: border-box;
    width: 56px;
    height: 28px;
    border: 1px solid rgba(0, 0, 0, .1);
    border-radius: 25%/50%;
    vertical-align: top;
    background: #eee;
    transition: .2s;
}

.checkbox-ios .checkbox-ios-switch:before {
    content: '';
    position: absolute;
    top: 1px;
    left: 1px;
    display: inline-block;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: white;
    box-shadow: 0 3px 5px rgba(0, 0, 0, .3);
    transition: .15s;
}

.checkbox-ios input[type=checkbox] {
    display: block;
    width: 0;
    height: 0;
    position: absolute;
    z-index: -1;
    opacity: 0;
}

.checkbox-ios input[type=checkbox]:not(:disabled):active + .checkbox-ios-switch:before {
    box-shadow: inset 0 0 2px rgba(0, 0, 0, .3);
}

.checkbox-ios input[type=checkbox]:checked + .checkbox-ios-switch {
    background: limegreen;
}

.checkbox-ios input[type=checkbox]:checked + .checkbox-ios-switch:before {
    transform: translateX(28px);
}

/* Hover */
.checkbox-ios input[type="checkbox"]:not(:disabled) + .checkbox-ios-switch {
    cursor: pointer;
    border-color: rgba(0, 0, 0, .3);
}

/* Disabled */
.checkbox-ios input[type=checkbox]:disabled + .checkbox-ios-switch {
    filter: grayscale(70%);
    border-color: rgba(0, 0, 0, .1);
}

.checkbox-ios input[type=checkbox]:disabled + .checkbox-ios-switch:before {
    background: #eee;
}

/* Focus */
.checkbox-ios.focused .checkbox-ios-switch:before {
    box-shadow: inset 0px 0px 4px #ff5623;
}
</style>
