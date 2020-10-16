<template>
    <div class="row">
        {{form}}
        <div class="centered-window">
            {{errorList}}
            <div class="form-group  ">
                <label for="inputName">Ваше имя</label>
                <input type="email" class="form-control" id="inputName" aria-describedby="emailHelp" v-model="form.name">
                <small id="nameHelp" class="form-text text-muted">Не знаю, что здесь писать</small>
            </div>

            <div class="form-group  ">
                <label for="inputEmail">Элетронная почта</label>
                <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" v-model="form.email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

            </div>
            <div class="form-group">
                <label for="InputPassword1">Пароль</label>
                <input type="password" class="form-control" id="InputPassword1" v-model="form.password">
            </div>

            <div class="form-group">
                <label for="InputPassword2">Пароль еще раз</label>
                <input type="password" class="form-control" id="InputPassword2" v-model="form.reenterPassword">
            </div>

            <button type="submit" class="btn btn-primary" @click="registerUser">Регистрация</button>
            <button type="reset" class="btn btn-outline-secondary">Отмена</button>
        </div>

    </div>



</template>


<script>

    export default {
        data: ()=> {
            return {
                form: {
                    email: '',
                    name: '',
                    password: '',
                    reenterPasword: ''
                },

            }
        },
        methods: {
            registerUser() {
                axios.post('/api/register',
                    {
                        name: this.form.name,
                        email: this.form.email,
                        password: this.form.password
                    }
                ).then(res=>{
                    console.log(res)
                    this.$router.push('home')
                })
                .catch(err=>console.log(err))
            },
        },
        computed: {
            errorList: ()=> {
                let passwordErrors=[];

                // if (this.form.password!==this.form.reenterPassword) passwordErrors.push('Введенные пароли не совпадают');
                if (this.form.password.length()<8) {
                    passwordErrors.push('Длина пароля должна быть не менее 8 символов')
                }

                return {
                    passwordEL: passwordErrors
                }
            }
        }
    }

</script>
