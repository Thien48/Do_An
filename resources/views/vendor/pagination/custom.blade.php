{{-- <style>
    /* CSS cho nút phân trang */
.pagination {
    list-style-type: none;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a,
.pagination li span {
    display: inline-block;
    padding: 8px 12px;
    background-color: #e0e0e0;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
}

.pagination li.active span {
    background-color: #333;
    color: #fff;
}

.pagination li.disabled span {
    background-color: #f1f1f1;
    color: #999;
    cursor: not-allowed;
}
</style>

@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Nút trang đầu --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->url(1) }}">&laquo;</a></li>
        @endif

        {{-- Các trang đầu --}}
        @foreach ($elements as $element)
            {{-- Hiển thị các trang --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Hiển thị trang hiện tại và trang đầu tiên --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @elseif ($page == $paginator->currentPage() - 1 || $page == $paginator->lastPage())
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @elseif ($page == 3 && $paginator->lastPage() > 5)
                        <li class="disabled"><span>...</span></li>
                        @break
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Hiển thị 2 trang cuối --}}
        @if ($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="disabled"><span>...</span></li>
            @for ($i = $paginator->lastPage() - 1; $i <= $paginator->lastPage(); $i++)
                @if ($i == $paginator->currentPage())
                    <li class="active"><span>{{ $i }}</span></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor
        @endif

        {{-- Nút trang cuối --}}
        @if ($paginator->currentPage() < $paginator->lastPage() - 1)
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif --}}