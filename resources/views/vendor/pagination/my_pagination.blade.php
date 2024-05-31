@if ($paginator->hasPages())
    <div class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            {{-- <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div> --}}

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif
                    {{-- ===================================================== --}}
                    @if ($paginator->currentPage() > 2)
                        <li class="page-item"><a href="{{ $paginator->url(1) }}" class="page-link">1</a>
                        </li>
                    @endif

                    @if ($paginator->currentPage() > 3)
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                    @endif

                    @foreach (range(1, $paginator->lastPage()) as $item)
                        @if ($item >= $paginator->currentPage() - 1 && $item <= $paginator->currentPage() + 1)
                            @if ($item == $paginator->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $item }}</span>
                                </li>
                            @else
                                <li class="page-item"><a href="{{ $paginator->url($item) }}"
                                        class="page-link">{{ $item }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach

                    @if ($paginator->currentPage() + 2 < $paginator->lastPage())
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                    @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                        <li class="page-item"><a href="{{ $paginator->url($paginator->lastPage()) }}"
                                class="page-link">{{ $paginator->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
