{{-- @if ($paginator->hasPages()) --}}
<nav class="mt-2 d-inline-flex">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item"><a class="page-link disabled" href="#" aria-label="First"><i class="bi bi-chevron-double-left"></i></a></li>
        <li class="page-item"><a class="page-link disabled" href="#" aria-label="Previous"><i class="bi bi-chevron-left"></i></a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}" aria-label="First"><i class="bi bi-chevron-double-left"></i></a></li>
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous"><i class="bi bi-chevron-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item"><a class="page-link disabled" href="#">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="page-item"><a class="page-link active" href="#">{{ $page }}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next"><i class="bi bi-chevron-right"></i></a></li>
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last"><i class="bi bi-chevron-double-right"></i></a></li>
        @else
        <li class="page-item"><a class="page-link disabled" href="#" aria-label="Next"><i class="bi bi-chevron-right"></i></a></li>
        <li class="page-item"><a class="page-link disabled" href="#" aria-label="Last"><i class="bi bi-chevron-double-right"></i></a></li>
        @endif
    </ul>
    <ul class="pagination justify-content-end">
        <li class="page-item disabled"><a class="page-link disabled">{{$paginator->perPage()*$paginator->currentPage()-($paginator->perPage()-$paginator->count())}} de {{$paginator->total()}}</a></li>
    </ul>
</nav>
{{-- @endif --}}