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
                <button id="userRegisterBtn">
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
                    <td><i id="edit-btn-{{ $user->id }}" class="edit-btn fa-solid fa-pen-to-square"></i></td>
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

    @include('partials.user-register-modal')
    @include('partials.user-edit-modal')

@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>

    <script>
        /**
         * @type {HTMLDivElement}
         */
        const registerModal = document.getElementById("register-modal");
        const openUserModalButton = document.getElementById("userRegisterBtn");
        const registerCloseModalButton = document.getElementById("register-close");

        openUserModalButton.onclick = function() {
            registerModal.style.display = 'flex';
        }

        registerCloseModalButton.onclick = function() {
            registerModal.style.display = "none";
        }
    </script>

    <script>
        /**
         * @type {HTMLDivElement}
         */
        const editModal = document.getElementById("edit-modal");
        const openEditModalButtons = document.querySelectorAll(".edit-btn");
        const editCloseModalButton = document.getElementById("edit-close");

        // let userId = 1;

        openEditModalButtons.forEach(button => {
            button.addEventListener("click", function() {
                // userId = event.target.id.match(/edit-btn-(\d+)/)[1];
                // console.log(userId);

                const row = button.closest('tr');
                const cells = row.getElementsByTagName("td");

                let login = cells[1].innerText;
                let group = (cells[4].innerText !== '-') ? cells[4].innerText : '';

                let name = cells[2].innerText.split(' ');
                let first_name = name[0];
                let last_name = name[1];

                document.getElementById("edit-firstName").value = first_name;
                document.getElementById("edit-lastName").value = last_name;
                document.getElementById("edit-login").value = login;
                document.getElementById("edit-group").value = group;

                editModal.style.display = "flex";
            });
        });

        editCloseModalButton.onclick = function() {
            editModal.style.display = "none";
        }
    </script>
@endsection
