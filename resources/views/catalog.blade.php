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
                        <option value="title">Название</option>
                        <option value="author">Автор</option>
                        <option value="publisher">Издатель</option>
                        <option value="amount">Количество</option>
                    </select>
                </div>
            </div>

            <div class="functions-right">
                <button id="bookCreateBtn" class="yellow">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                    <span>Добавить</span>
                </button>
                {{ $books->links('vendor.pagination.custom-table') }}
            </div>
        </div>

        <table id="info-table">
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
                <tr data-id="{{ $book->id }}">
                    <td><i class="edit-btn fa-solid fa-pen-to-square"></i></td>
                    <td>{{ $book->title }}</td>

                    <td>
                        @if(isset($book->authors) && count($book->authors) > 0)
                            {{ mb_substr($book->authors[0]->first_name, 0, 1) }}. {{ $book->authors[0]->last_name }}
                            @if(count($book->authors) > 1)
                                    и др.
                            @endif
                        @else
                            -
                        @endif
                    </td>

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

    @include('partials.book-modal')

@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>
    <script src="{{ asset('js/book-modal.js') }}"></script>
@endsection
