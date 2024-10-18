@if ($paginator->lastPage() > 1)
    <div class="pagination">
        <a class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}"
           href="{{ $paginator->url($paginator->currentPage()-1) . '&sort=' . request('sort') }}">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <a class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}"
               href="{{ $paginator->url($i) . '&sort=' . request('sort') }}">
                {{ $i }}
            </a>
        @endfor
        <a class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}"
           href="{{ $paginator->url($paginator->currentPage()+1) . '&sort=' . request('sort') }}">
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>
@endif
