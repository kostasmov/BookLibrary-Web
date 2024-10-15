@extends('layouts.app')

@section('title', 'Профиль')

@section('head-scripts')
    <link rel='stylesheet' href={{ asset('css/table.css') }}>
    <link rel='stylesheet' href={{ asset('css/modal.css') }}>
@endsection

@section('content')
    <div class='table-container'>
        <div class='controls'>

            <div class='functions-left'>
                @include('partials.search-bar')

                <div class='sort-container'>
                    <label for='sort-select'>Сортировать по: </label>
                    <select id='sort-select'>
                        <option value='name'>Имя</option>
                        <option value='group'>Группа</option>
                        <option value='login'>Логин</option>
                    </select>
                </div>
            </div>

            <div class='functions-right'>
                <button id='userRegisterBtn'>
                    <i class="fa-sharp fa-solid fa-plus"></i>
                    <span>Добавить</span>
                </button>
                {{ $users->links('vendor.pagination.custom2') }}
            </div>
        </div>

        <table id='info-table'>
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
                <tr id='user-{{ $user->id }}'>
                    <td><i class="edit-btn fa-solid fa-pen-to-square"></i></td>
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

{{--    @include('partials.user-register-modal')--}}
{{--    @include('partials.user-edit-modal')--}}

    @include('partials.user-modal')

@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>

    <script>
        /**
         * @type {HTMLDivElement}
         */
        const modal = document.getElementById('modal');
        const closeModalButton = document.getElementById('close');

        /**
         * @type {HTMLDivElement}
         */
        const passwordGroup = document.getElementById('password-group');
        const modalName = document.getElementById('modal-name');

        /**
         * @type {HTMLButtonElement}
         */
        const deleteButton = document.getElementById('delete-button');
        const saveButton = document.getElementById('save-button');

        const openRegisterModalButton = document.getElementById('userRegisterBtn');
        const openEditModalButtons = document.querySelectorAll('.edit-btn');

        // Открыть окно регистрации читателя
        openRegisterModalButton.onclick = function() {
            modal.style.display = 'flex';

            modalName.textContent = 'Регистрация читателя';
            deleteButton.style.display = 'none';
            passwordGroup.style.display = 'flex'
        }

        // Открыть окно редактирования пользователя
        openEditModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const cells = row.getElementsByTagName('td');

                let userId = row.id.match(/user-(\d+)/)[1];
                console.log(userId);

                let login = cells[1].innerText;
                let group = (cells[4].innerText !== '-') ? cells[4].innerText : '';

                let full_name = cells[2].innerText.split(' ');
                let first_name = full_name[0];
                let last_name = full_name[1];

                document.getElementById('firstName').value = first_name;
                document.getElementById('lastName').value = last_name;
                document.getElementById('login').value = login;
                document.getElementById('group').value = group;

                modal.style.display = 'flex';

                modalName.textContent = 'Редактирование пользователя';
                deleteButton.style.display = 'block';
                passwordGroup.style.display = 'none'
            });
        });

        closeModalButton.onclick = function() {
            modal.style.display = 'none';

            document.getElementById('firstName').value = '';
            document.getElementById('lastName').value = '';
            document.getElementById('login').value = '';
            document.getElementById('group').value = '';
        }
    </script>
@endsection
