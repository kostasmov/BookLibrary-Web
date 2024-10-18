@extends('layouts.app')

@section('title', 'Профиль')

@php
    $statuses = [
        'issued' => 'Выдана',
        'pending' => 'На рассмотрении',
        'returned' => 'Возвращена',
        'rejected' => 'Отказано'
    ]
@endphp

@section('head-scripts')
    <link rel="stylesheet" href={{ asset('css/table.css') }}>
@endsection

@section('content')
    <div class="table-container">
        <div class="controls">
            <form id="sortForm" method="get" action="{{ route('tracker') }}">
                <div class="sort-container">
                    <label for="sort-select">Сортировать по: </label>
                    <select id="sort-select" name="sort" onchange="document.getElementById('sortForm').submit();">
                        <option value="issue" {{ request('sort') == 'issue' ? 'selected' : '' }}>Дата выдачи</option>
                        <option value="return" {{ request('sort') == 'return' ? 'selected' : '' }}>Дата возврата</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Название</option>
                    </select>
                </div>
            </form>

            {{ $issuances->links('vendor.pagination.custom-table') }}
        </div>

        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Дата выдачи</th>
                <th>Дата возврата</th>
                <th>Состояние</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($issuances as $issuance)
                <tr>
                    <td>{{ $issuance->book->title }}</td>
                    <td>
                        @if(count($issuance->book->authors) > 0)
                            {{ $issuance->book->authors[0]->first_name }} {{ $issuance->book->authors[0]->last_name }}
                            @if(count($issuance->book->authors) > 1)
                                и др.
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $issuance->book_date ?? '-' }}</td>
                    <td
                        @if(strtotime($issuance->return_date) < time() && $issuance->status === 'issued')
                            class="expired"
                        @endif
                    >
                        {{ $issuance->return_date ?? '-' }}
                    </td>
                    <td>
                        <span class="status {{$issuance->status}}">
                            {{ $statuses[$issuance->status] }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
