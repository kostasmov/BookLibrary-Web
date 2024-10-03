<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Название страницы')</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href={{ asset('css/style.css') }}>
    {{--    @vite(['resources/css/style.css'])--}}

        @yield('head-scripts')
    </head>

    <body>
        @include('partials.sidebar')

        <div class="content">
            <header>
                <span class="user-info">
                    <span class="user-name">Иван Иванович</span>
                    <span class="user-role">role</span>
                </span>
                <a href="#" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>Выйти
                </a>
            </header>

            <div class="main-content">
                <!-- Основной контент -->
            </div>

            @yield('foot-scripts')
        </div>
    </body>
</html>
