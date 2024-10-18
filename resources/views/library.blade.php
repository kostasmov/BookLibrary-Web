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
    <link rel='stylesheet' href={{ asset('css/library.css') }}>
    <link rel="stylesheet" href={{ asset('css/control-bar.css') }}>
@endsection

@section('content')
    <div class="control-bar">
        @include('partials.search-bar')

        <form id="sortForm" method="GET" action="{{ route('library') }}">
            <div class="sort-container">
                <label for="sort">Сортировать по:</label>
                <select id="sort" class="sort-select" name="sort" onchange="document.getElementById('sortForm').submit();">
                    <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Дата публикации</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Название</option>
                    <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Автор</option>
                </select>
            </div>
        </form>
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