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
                        <option value="return-date">Название</option>
                        <option value="return-date">Автор</option>
                        <option value="return-date">Издатель</option>
                        <option value="return-date">Количество</option>
                    </select>
                </div>
            </div>

            <div class="functions-right">
                {{ $books->links('vendor.pagination.custom2') }}
            </div>
        </div>

        <table>
            <thead>
            <tr>
                <th></th>
                <th>Название</th>
                <th>Автор</th>
                <th>Издатель</th>
                <th>Год</th>
                <th>Тип</th>
                <th>Всего</th>
                <th>Выдано</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td><i class="fa-solid fa-pen-to-square"></i></td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->authors[0]->last_name ?? '-' }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->book_year }}</td>
                    <td>{{ $book->type }}</td>
                    <td>{{ $book->amount }}</td>
                    <td>{{ $book->issuances }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
