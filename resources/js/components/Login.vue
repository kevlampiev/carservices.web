<template>
    <div class="row">
        <div class="centered-window">
            <div class="form-group  ">
                <label for="inputEmail">Электронная почта</label>
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="inputPassword">Пароль</label>
                <input type="password" class="form-control" id="inputPassword">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="Check">
                <label class="form-check-label" for="Check">Запомнить меня</label>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
            <button type="reset" class="btn btn-outline-secondary">Отмена</button>
        </div>
    </div>

</template>
