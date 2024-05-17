@if ($paginator->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-boxes">
            @if ($paginator->onFirstPage())
                <a class="pagination-box" href="javascript:void(0);"><i class="fa-solid fa-angle-left"></i></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-box"><i
                        class="fa-solid fa-angle-left"></i></a>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <a class="pagination-box ">
                        <p>...</p>
                    </a>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="javascript:void(0);" class="pagination-box active">
                                <p>{{ $page }}</p>
                            </a>
                        @else
                            <a href="{{ $url }}" class="pagination-box">
                                <p>{{ $page }}</p>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-box"><i
                        class="fa-solid fa-angle-right"></i></a>
            @else
                <a href="javascript:void(0);" class="pagination-box"><i class="fa-solid fa-angle-right"></i></a>
            @endif
        </div>
    </div>
@endif
