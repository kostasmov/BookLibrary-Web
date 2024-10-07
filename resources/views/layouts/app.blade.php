<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Название страницы')</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href={{ asset('css/style.css') }}>
    {{--    @vite(['resources/css/style.css'])--}}

        @php
            $reader = auth()->user()->reader;
            $full_name = $reader->first_name . ' ' . $reader->last_name
        @endphp

        @yield('head-scripts')
    </head>

    <body>
        @include('partials.sidebar')

        <div class="content">
            <header>
                <span class="user-info">
                    <span class="user-name">{{ $full_name }}</span>
                    <span class="user-role"> {{ auth()->user()->role }}</span>
                </span>
                <a href="{{ route('logout') }}" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>Выйти
                </a>
            </header>

            <div class="main-content">
                @yield('content')
            </div>

            @yield('foot-scripts')
        </div>
    </body>
</html>
