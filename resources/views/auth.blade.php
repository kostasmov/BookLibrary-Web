<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Авторизация</title>
        <link rel="stylesheet" href={{ asset('css/style.css') }}>
        {{--    @vite(['resources/css/style.css'])--}}
    </head>

    <body>
        <div class="auth-banner">
        </div>

        <img class="banner-img" src="{{ asset('images/banner.png') }}" alt="Баннер">

        <div class="auth">
            <img src="{{ asset('images/logo.png') }}" alt="Логотип">

            <form method="post" id="authForm">
                @csrf

                <label for="login">Логин:</label>
                <input type="text" id="login" name="login">

                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password">

                @if ($errors->any())
                    <span class="error">{{ $errors->first() }}</span>
                @endif

                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
</html>
