<div class="book-card">
    <div class='image-container {{ $book->cover == NULL ? 'no-image' : '' }}'>
        @if ($book->cover)
            <img src="{{ asset('storage/covers/' . $book->cover) }}" alt="Обложка книги">
        @endif
    </div>
    <div class="book-info">
        <div class="category">{{ $book_types[$book->type] }}</div>
        <div class="title">{{ $book->title }}</div>
        <div class="author">
            @if(count($book->authors) > 0)
                {{ $book->authors[0]->first_name }} {{ $book->authors[0]->last_name }}
                @if(count($book->authors) > 1)
                    и др.
                @endif
            @else
                -
            @endif
        </div>
        <div class="publishing">{{ $book->publisher }}, {{ $book->book_year }}</div>
        <div class="actions">
            <button>Взять на дом</button>
        </div>
    </div>
</div>
