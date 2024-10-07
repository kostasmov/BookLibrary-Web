@if ($paginator->lastPage() > 1)
    <div class="pagination">
        <a class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}"
           href="{{ $paginator->url(1) }}">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        <div class="active">
            {{ $paginator->currentPage() }}
        </div>
        <a class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}"
           href="{{ $paginator->url($paginator->currentPage()+1) }}" >
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>
@endif
