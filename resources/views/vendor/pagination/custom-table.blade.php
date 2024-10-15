@if ($paginator->lastPage() > 1)
    <div class="pagination">
        <a class="{{ ($paginator->currentPage() == 1) ? ' disabled' : 'enabled' }}"
           href="{{ $paginator->url($paginator->currentPage()-1) }}">
            <i class="fa-solid fa-angle-left"></i>
        </a>

        <a href="#">{{ $paginator->currentPage() }}</a>

        <a class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : 'enabled' }}"
           href="{{ $paginator->url($paginator->currentPage()+1) }}" >
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>
@endif
