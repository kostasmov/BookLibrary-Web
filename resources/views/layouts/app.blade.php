<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Название страницы')</title>

        <link rel="stylesheet" href={{ asset('style.css') }}>
    {{--    @vite(['resources/css/style.css'])--}}

        @yield('head-scripts')
    </head>

    <body>
        <div class="container">
            @include('partials.sidebar')

            <main class="profile-section">
                <div class="header">
                    <span class="user-name">Вероника Морозова <span class="admin">admin</span></span>
                    <a href="#" class="logout">Выйти</a>
                </div>

                <div class="info">
                    @yield('content')
                </div>
            </main>
        </div>

        @yield('foot-scripts')
    </body>
</html>
