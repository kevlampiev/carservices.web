<template>
    <div class="row">
        <div class="centered-window">
            <div class="form-group  ">
                <label for="inputName">Ваше имя</label>
                <input type="email" class="form-control" id="inputName" aria-describedby="emailHelp"
                       v-model="form.name">
                <div class="alert alert-danger" v-if="showValidationRes&&(errorList.nameEl.length>0)">
                    <li v-for="(errItem,index) in errorList.nameEl">
                        {{errItem}}
                    </li>
                </div>

            </div>

            <div class="form-group  ">
                <label for="inputEmail">Элетронная почта</label>
                <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp"
                       v-model="form.email">
                <div class="alert alert-danger" v-if="showValidationRes&&(errorList.emailEl.length>0)">
                    <li v-for="(errItem,index) in errorList.emailEl">
                        {{errItem}}
                    </li>
                </div>

            </div>
            <div class="form-group">
                <label for="InputPassword1">Пароль</label>
                <input type="password" class="form-control" id="InputPassword1" v-model="form.password">
                <div class="alert alert-danger" v-if="showValidationRes&&(errorList.passwordEL.length>0)">
                    <li v-for="(errItem,index) in errorList.passwordEL">
                        {{errItem}}
                    </li>
                </div>

            </div>

            <div class="form-group">
                <label for="InputPassword2">Пароль еще раз</label>
                <input type="password" class="form-control" id="InputPassword2" v-model="form.reenterPassword">
            </div>

            <button type="submit" class="btn btn-primary" @click="registerUser">Регистрация</button>
            <button type="reset" class="btn btn-outline-secondary" @click="cancelRegistration">Отмена</button>
        </div>

    </div>


</template>


<script>

    export default {
        data: () => {
            return {
                form: {
                    email: '',
                    name: '',
                    password: '',
                    reenterPasword: ''
                },
                showValidationRes: false, //отображать или нет результат валидации
            }
        },
        methods: {
            registerUser() {
                this.showValidationRes = true
                if (this.errorList.numbOfErrors !== 0) {
                    alert(1)
                } else {
                    axios.post('/api/register',
                        {
                            name: this.form.name,
                            email: this.form.email,
                            password: this.form.password
                        }
                    ).then(res => {
                        this.proceedRegistration(res)
                        this.$router.push('home')
                    })
                        .catch(err => console.log(err))
                }
            },

            cancelRegistration() {
                this.$router.push('home')
            },

            //Вспомогательные функции валидации
            getNameValidErrors() {
                let nameErrors = []
                if (this.form.name.length === 0) {
                    nameErrors.push('Поле Имя не может быть пустым')
                }
                return nameErrors
            },

            getPswdValidErrors() {
                let passwordErrors = []
                if (this.form.password !== this.form.reenterPassword) passwordErrors.push('Введенные пароли не совпадают');
                if (this.form.password.length < 8) {
                    passwordErrors.push('Длина пароля должна быть не менее 8 символов')
                }
                return passwordErrors
            },

            getEmailValidErrors() {
                let emailErrors = []
                let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/
                if (reg.test(this.form.email) == false) {
                    emailErrors.push('Значение ' + this.form.email + 'не является корректным адресом электроной почты ')
                }
                return emailErrors
            },

            //Функция обработки клиентского токена
            proceedRegistration(response) {
                if (!response.data.token) {
                    alert('Поле с токеном отсутствует')
                } else {
                    localStorage.userData = response.data.token
                    localStorage.userName = this.form.email
                }
                console.log(response)
            },
            showRegistrationError(error) {
                alert('Какая-то хрень ' + error.toString())
            },
        },
        computed: {
            errorList: function () {
                return {
                    numbOfErrors: this.getEmailValidErrors().length + this.getPswdValidErrors().length + this.getNameValidErrors().length,
                    nameEl: this.getNameValidErrors(),
                    emailEl: this.getEmailValidErrors(),
                    passwordEL: this.getPswdValidErrors(),
                }
            }
        }
    }

</script>
