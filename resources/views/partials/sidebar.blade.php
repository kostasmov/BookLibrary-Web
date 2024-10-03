<div class="sidebar">
        <img src="{{ asset('images/logo.png') }}" alt="Логотип">
    <nav>
        <ul>
            <li class="{{ Route::is('profile') ? 'active' : '' }}">
                <a href="{{ route('profile') }}" ><i class="fas fa-user"></i> Профиль</a>
            </li>
            <li class="{{ Route::is('library') ? 'active' : '' }}">
                <a href="{{ route('library') }}"><i class="fas fa-book"></i> Библиотека</a>
            </li>
            <li class="{{ Route::is('checkout') ? 'active' : '' }}">
                <a href="{{ route('checkout') }}" ><i class="fas fa-list-alt"></i> Формуляр</a>
            </li>
            <li class="{{ Route::is('users') ? 'active' : '' }}">
                <a href="{{ route('users') }}" ><i class="fas fa-users"></i> Пользователи</a>
            </li>
            <li class="{{ Route::is('catalog') ? 'active' : '' }}">
                <a href="{{ route('catalog') }}" ><i class="fas fa-book-open"></i> Книги</a>
            </li>
            <li class="{{ Route::is('issuances') ? 'active' : '' }}">
                <a href="{{ route('issuances') }}" ><i class="fas fa-file-alt"></i> Выдачи</a>
            </li>
        </ul>
    </nav>
</div>
