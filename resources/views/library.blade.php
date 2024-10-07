@extends('layouts.app')

@section('title', 'Профиль')

@php
    $book_types = [
        'technic' => 'Техн. литература',
        'fiction' => 'Худ. литература'
    ]
@endphp

@section('head-scripts')
    <link rel="stylesheet" href={{ asset('css/control-bar.css') }}>
@endsection

@section('content')
    <div class="control-bar">
        <div class="search-bar">
            <input type="text" placeholder="Поиск...">
            <i class="fas fa-search"></i>
        </div>

        <div class="sort-container">
            <label for="sort">Сортировать по:</label>
            <select id="sort" class="sort-select">
                <option value="date">Дата публикации</option>
                <option value="title">Название</option>
                <option value="author">Автор</option>
            </select>
        </div>

        @include('partials.filter')
    </div>

    <div class="book-grid">
        @foreach ($books as $book)
            @include('partials.book-card')
        @endforeach
    </div>

    {{ $books->links('vendor.pagination.custom') }}
@endsection
