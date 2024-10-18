<div class="search-bar">
    <input type="text" value="{{ request('search') ?? '' }}" id="searchInput" placeholder="Поиск..." onkeypress="handleKeyPress(event)">
    <i class="fas fa-search"></i>
</div>
