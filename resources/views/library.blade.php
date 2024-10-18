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

        <form id="sortForm" method="get" action="{{ route('library') }}">
            <div class="sort-container">
                <label for="sort">Сортировать по:</label>
                <select id="sort" class="sort-select" name="sort" onchange="document.getElementById('sortForm').submit();">
                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>-</option>
                    <option value="year" {{ request('sort') == 'year' ? 'selected' : '' }}>Год публикации</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Название</option>
                </select>
            </div>
        </form>

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
