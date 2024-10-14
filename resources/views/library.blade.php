@extends('layouts.app')

@section('title', 'Профиль')

@php
    $book_types = [
        'technic' => 'Техн. литература',
        'fiction' => 'Худ. литература'
    ];

    $book_statuses = [
        'issued' => 'На руках',
        'pending' => 'На проверке',
        'available' => 'Взять на дом',
        'not-available' => 'Не доступна'
    ];
@endphp

@section('head-scripts')
    <link rel="stylesheet" href={{ asset('css/control-bar.css') }}>
    <style>
        .pagination {
            margin-top: 30px;
            margin-bottom: 80px;
        }
    </style>
@endsection

@section('content')
    <div class="control-bar">
        @include('partials.search-bar')

        <div class="sort-container">
            <label for="sort">Сортировать по:</label>
            <select id="sort" class="sort-select">
                <option value="date">Дата публикации</option>
                <option value="title">Название</option>
                <option value="author">Автор</option>
            </select>
        </div>

{{--        @include('partials.filter')--}}
    </div>

    <div class="book-grid">
        @foreach ($books as $book)
            @include('partials.book-card')
        @endforeach
    </div>

    {{ $books->links('vendor.pagination.custom') }}

    @if ($errors->any())
        <script>alert( '{{ $errors->first() }}' );</script>
    @endif
@endsection
