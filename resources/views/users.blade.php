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
                @include('partials.search-bar')

                <div class="sort-container">
                    <label for="sort-select">Сортировать по: </label>
                    <select id="sort-select">
                        <option value="name">Имя</option>
                        <option value="group">Группа</option>
                        <option value="login">Логин</option>
                    </select>
                </div>
            </div>

            <div class="functions-right">
                <button id="userRegisterBtn" class="yellow">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                    <span>Добавить</span>
                </button>
                {{ $users->links('vendor.pagination.custom-table') }}
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
                <tr id="user-{{ $user->id }}">
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

    @include('partials.user-modal')

@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>
    <script src="{{ asset('js/user-modal.js') }}"></script>
@endsection
