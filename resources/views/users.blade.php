@extends('layouts.app')

@section('title', 'Профиль')

@section('head-scripts')
    <link rel="stylesheet" href={{ asset('css/table.css') }}>
    <link rel="stylesheet" href={{ asset('css/modal.css') }}>
@endsection

@section('content')
    <div class="table-container">
        <div class="controls">
            <div class="functions-left">
                <div class="search-bar">
                    <input type="text" placeholder="Поиск...">
                    <i class="fas fa-search"></i>
                </div>

                <div class="sort-container">
                    <label for="sort-select">Сортировать по: </label>
                    <select id="sort-select">
                        <option value="return-date">Имя</option>
                        <option value="return-date">Группа</option>
                        <option value="return-date">Логин</option>
                    </select>
                </div>
            </div>

            <div class="functions-right">
                <button id="openModalBtn">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                    <span>Добавить</span>
                </button>
                {{ $users->links('vendor.pagination.custom2') }}
            </div>
        </div>

        <table id="info-table">
            <thead>
            <tr>
                <th></th>
                <th>Название</th>
                <th>Имя</th>
                <th>Роль</th>
                <th>Группа</th>
                <th>Почта</th>
                <th>Телефон</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><i class="fa-solid fa-pen-to-square"></i></td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->reader->first_name }} {{ $user->reader->last_name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->reader->group_code ?? '-' }}</td>
                    <td>{{ $user->reader->email ?? '-' }}</td>
                    <td>{{ $user->reader->phone ?? '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="form-row">
                <h2>Регистрация читателя</h2>
                <span class="close"><i class="fa-solid fa-xmark"></i></span>
            </div>

            <form class="form-container">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">Имя:</label>
                        <input type="text" id="firstName" name="firstName">
                    </div>

                    <div class="form-group">
                        <label for="lastName">Фамилия:</label>
                        <input type="text" id="lastName" name="lastName">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="login">Логин:</label>
                        <input type="text" id="login" name="login">
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <input type="text" id="password" name="password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="group">Группа:</label>
                        <input type="text" id="group" name="group">
                    </div>
                </div>

                <div class="form-row button-row">
                    <button type="submit">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>

    <script>
        /**
         * @type {HTMLDivElement}
         */
        const modal = document.getElementById("modal");
        const openModalBtn = document.getElementById("openModalBtn");
        const closeBtn = document.getElementsByClassName("close")[0];

        openModalBtn.onclick = function() {
            modal.style.display = 'flex';
            // modal.style.justifyContent = 'center';
            // modal.style.alignContent = 'center;'
        }

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    </script>
@endsection
