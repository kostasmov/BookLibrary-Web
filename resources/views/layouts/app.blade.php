@php
    use App\Models\User;

    $user = auth()->user();
    if (!$user instanceof User) {
        throw new Exception("Ошибка пользователя");
    }

    $reader = $user->reader;
    $full_name = $reader->first_name . ' ' . $reader->last_name
@endphp

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Название страницы')</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href={{ asset('css/style.css') }}>

        @yield('head-scripts')
    </head>

    <body>
        @include('partials.sidebar')

        <div class="content">
            <header>
                <span class="user-info">
                    <span class="user-name">{{ $full_name }}</span>
                    <span class="user-role"> {{ $user->role }}</span>
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
