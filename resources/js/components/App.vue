<template>
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">
                        <router-link :to="{ name: 'home' }">Главная</router-link>
                    </a>
                    <a class="nav-item nav-link" href="#">
                        <router-link :to="{ name: 'hello' }">Привет, мир</router-link>
                    </a>
                </div>
            </div>

            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-item nav-link" href="#">
                        <router-link :to="{ name: 'register' }">Регистрация</router-link>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="#">
                        <router-link :to="{ name: 'login' }">Войти</router-link>
                    </a>
                </li>
            </ul>


        </nav>


        <!--        <passport-clients></passport-clients>-->
        <!--        <passport-authorized-clients></passport-authorized-clients>-->
        <!--        <passport-personal-access-tokens></passport-personal-access-tokens>-->


        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>
