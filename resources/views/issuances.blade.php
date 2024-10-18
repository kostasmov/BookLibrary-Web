@extends('layouts.app')

@section('title', 'Профиль')

@section('head-scripts')
    <link rel="stylesheet" href={{ asset('css/table.css') }}>

    @php
        $statuses = [
            'issued' => 'Выдана',
            'pending' => 'На рассмотрении',
            'returned' => 'Возвращена',
            'rejected' => 'Отказано'
        ]
    @endphp
@endsection

@section('content')
    <div class="table-container">
        <div class="controls">
            <div class="functions-left">
                @include('partials.search-bar')

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
                <button id="issuanceReturn" class="yellow">
                    <i class="fa-solid fa-box-open"></i>
                    <span>Возврат</span>
                </button>

                <button id="issuanceAccept" class="yellow">
                    <i class="fa-solid fa-check"></i>
                    <span>Выдать</span>
                </button>

                <button id="issuanceReject" class="grey">
                    <i class="fa-solid fa-xmark"></i>
                    <span>Отказ</span>
                </button>

                {{ $issuances->links('vendor.pagination.custom-table') }}
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
                <tr data-id="{{ $issuance->id }}">
                    <td>{{ $issuance->book->title }}</td>
                    <td>{{ mb_substr($issuance->reader->first_name, 0, 1) }}. {{ $issuance->reader->last_name  }}</td>
                    <td>{{ $issuance->book_date ?? '-' }}</td>
                    <td
                        @if(strtotime($issuance->return_date) < time() && $issuance->status === 'issued')
                            class="expired"
                        @endif
                    >
                        {{ $issuance->return_date ?? '-' }}
                    </td>
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
{{--    <script src="{{ asset('js/table.js') }}"></script>--}}
    <script src="{{ asset('js/issuances.js') }}"></script>
@endsection
