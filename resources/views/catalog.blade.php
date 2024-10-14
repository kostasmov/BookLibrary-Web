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
                        <option value="return-date">Название</option>
                        <option value="return-date">Автор</option>
                        <option value="return-date">Издатель</option>
                        <option value="return-date">Количество</option>
                    </select>
                </div>
            </div>

            <div class="functions-right">
                <button id="bookCreateBtn">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                    <span>Добавить</span>
                </button>
                {{ $books->links('vendor.pagination.custom2') }}
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
                <tr id="book-{{ $book->id }}">
                    <td><i class="edit-btn fa-solid fa-pen-to-square"></i></td>
                    <td>{{ $book->title }}</td>

                    <td>
                        @if(isset($book->authors) && count($book->authors) > 0)
                            @if(!empty($book->authors[0]->last_name))
                                {{ mb_substr($book->authors[0]->first_name, 0, 1) }}. {{ $book->authors[0]->last_name }}
                            @else
                                {{ $book->authors[0]->first_name }}
                            @endif
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

{{--    @include('partials.book-create-modal')--}}
{{--    @include('partials.book-edit-modal')--}}

@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>

{{--    <script>--}}
{{--        /**--}}
{{--         * @type {HTMLDivElement}--}}
{{--         */--}}
{{--        const addBookModal = document.getElementById("create-modal");--}}
{{--        const openBookAddModalButton = document.getElementById("bookCreateBtn");--}}
{{--        const addCloseModalButton = document.getElementById("create-close");--}}

{{--        openBookAddModalButton.onclick = function () {--}}
{{--            addBookModal.style.display = 'flex';--}}
{{--        }--}}

{{--        addCloseModalButton.onclick = function () {--}}
{{--            addBookModal.style.display = "none";--}}
{{--        }--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        /**--}}
{{--         * @type {HTMLDivElement}--}}
{{--         */--}}
{{--        const editModal = document.getElementById("edit-modal");--}}
{{--        const openEditModalButtons = document.querySelectorAll(".edit-btn");--}}
{{--        const editCloseModalButton = document.getElementById("edit-close");--}}

{{--        openEditModalButtons.forEach(button => {--}}
{{--            button.addEventListener("click", function () {--}}
{{--                // Заполнение формы--}}

{{--                editModal.style.display = "flex";--}}
{{--            });--}}
{{--        });--}}

{{--        editCloseModalButton.onclick = function () {--}}
{{--            editModal.style.display = "none";--}}
{{--        }--}}
{{--    </script>--}}
@endsection
