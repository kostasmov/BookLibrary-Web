@extends('layouts.app')

@section('title', 'Профиль')

@section('head-scripts')
    <link rel="stylesheet" href={{ asset('css/table.css') }}>
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
                <button>
                    <i class="fa-sharp fa-solid fa-plus"></i>
                    <span>Добавить</span>
                </button>
                {{ $users->links('vendor.pagination.custom2') }}
            </div>
        </div>

        <table>
            <thead>
            <tr>
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
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->reader->first_name }} {{ $user->reader->last_name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->reader->group ?? '-' }}</td>
                    <td>{{ $user->reader->email ?? '-' }}</td>
                    <td>{{ $user->reader->phone ?? '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
