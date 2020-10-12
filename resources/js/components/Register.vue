<template>
    <div class="row">
        <div class="centered-window">
            <div class="form-group  ">
                <label for="inputName">Ваше имя</label>
                <input type="email" class="form-control" id="inputName" aria-describedby="emailHelp">
                <small id="nameHelp" class="form-text text-muted">Не знаю, что здесь писать</small>
            </div>

            <div class="form-group  ">
                <label for="inputEmail">Элетронная почта</label>
                <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="InputPassword1">Пароль</label>
                <input type="password" class="form-control" id="InputPassword1">
            </div>

            <div class="form-group">
                <label for="InputPassword2">Пароль еще раз</label>
                <input type="password" class="form-control" id="InputPassword2">
            </div>

            <button type="submit" class="btn btn-primary">Регистрация</button>
            <button type="reset" class="btn btn-outline-secondary">Отмена</button>
        </div>

    </div>

</template>
