@extends('layouts.app')

@section('title', 'Профиль')

@section('head-scripts')
    <link rel="stylesheet" href={{ asset('css/table.css') }}>

    @php
        $statuses = [
            'issued' => 'Выдана',
            'pending' => 'На рассмотрении',
            'returned' => 'Возвращена'
        ]
    @endphp
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
                        <option value="return-date">Дата возврата</option>
                        <option value="return-date">Дата выдачи</option>
                        <option value="return-date">Книга</option>
                    </select>
                </div>
            </div>

            <div class="functions-right">
                {{ $issuances->links('vendor.pagination.custom2') }}
            </div>
        </div>

        <table id="info-table">
            <thead>
            <tr>
                <th>Книга</th>
                <th>Читатель</th>
                <th>Дата выдачи</th>
                <th>Дата возврата</th>
                <th>Состояние</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($issuances as $issuance)
                <tr>
                    <td>{{ $issuance->book->title }}</td>
                    <td>{{ mb_substr($issuance->reader->first_name, 0, 1) }}. {{ $issuance->reader->last_name  }}</td>
                    <td>{{ $issuance->book_date ?? '-' }}</td>
                    <td
                        @if(strtotime($issuance->return_date) < time() && $issuance->status === 'issued')
                            class="expired"
                        @endif
                    >
                        {{ $issuance->return_date ?? '-' }}</td>
                    <td>
                        <span class="status {{ $issuance->status }}">
                            {{ $statuses[$issuance->status] }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('foot-scripts')
    <script src="{{ asset('js/table.js') }}"></script>
@endsection
