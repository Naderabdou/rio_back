@if ($paginator->hasPages())
    <div class="pagination">
        <ul>
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
            @else
                <li><i class="bi bi-chevron-right disabled"></i></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach (range(1, $paginator->lastPage()) as $i)
                @if ($i == $paginator->currentPage())
                    <li class="active"><a href="#">{{ $i }}</a></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
            @else
                <li><i class="bi bi-chevron-left disabled"></i></li>
            @endif
        </ul>
    </div>
@endif

