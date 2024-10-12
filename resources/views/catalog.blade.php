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
                        <option value="return-date">Название</option>
                        <option value="return-date">Автор</option>
                        <option value="return-date">Издатель</option>
                        <option value="return-date">Количество</option>
                    </select>
                </div>
            </div>

            <div class="functions-right">
                <button id="bookAddBtn">
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
                <tr>
                    <td><i id="edit-btn-{{ $book->id }}" class="edit-btn fa-solid fa-pen-to-square"></i></td>
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

    @include('partials.book-add-modal')
    @include('partials.book-edit-modal')

@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>

    <script>
        /**
         * @type {HTMLDivElement}
         */
        const addBookModal = document.getElementById("add-modal");
        const openBookAddModalButton = document.getElementById("bookAddBtn");
        const addCloseModalButton = document.getElementById("add-close");

        openBookAddModalButton.onclick = function() {
            addBookModal.style.display = 'flex';
        }

        addCloseModalButton.onclick = function() {
            addBookModal.style.display = "none";
        }
    </script>

    <script>
        /**
         * @type {HTMLDivElement}
         */
        const editModal = document.getElementById("edit-modal");
        const openEditModalButtons = document.querySelectorAll(".edit-btn");
        const editCloseModalButton = document.getElementById("edit-close");

        // let bookId = 1;

        openEditModalButtons.forEach(button => {
            button.addEventListener("click", function() {
                // bookId = event.target.id.match(/edit-btn-(\d+)/)[1];
                // console.log(bookId);

                const row = button.closest('tr');
                const cells = row.getElementsByTagName("td");

                // let login = cells[1].innerText;
                // let group = (cells[4].innerText !== '-') ? cells[4].innerText : '';
                //
                // let name = cells[2].innerText.split(' ');
                // let first_name = name[0];
                // let last_name = name[1];
                //
                // document.getElementById("edit-firstName").value = first_name;
                // document.getElementById("edit-lastName").value = last_name;
                // document.getElementById("edit-login").value = login;
                // document.getElementById("edit-group").value = group || '';

                editModal.style.display = "flex";
            });
        });

        editCloseModalButton.onclick = function() {
            editModal.style.display = "none";
        }
    </script>
@endsection
