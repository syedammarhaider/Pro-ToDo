@if ($paginator->hasPages())
    <nav class="d-flex justify-content-between align-items-center" aria-label="Pagination navigation">
        <!-- Mobile Pagination Info -->
        <div class="d-flex d-sm-none justify-content-center mb-3">
            <p class="small text-muted mb-0">
                <span class="badge bg-primary">{{ $paginator->currentPage() }}</span>
                <span class="mx-2">of</span>
                <span class="badge bg-secondary">{{ $paginator->lastPage() }}</span>
            </p>
        </div>

        <!-- Desktop Pagination Info -->
        <div class="d-none d-sm-block">
            <p class="small text-muted mb-0">
                <i class="fas fa-list me-1"></i>
                Showing
                <span class="fw-semibold text-primary">{{ $paginator->firstItem() }}</span>
                to
                <span class="fw-semibold text-primary">{{ $paginator->lastItem() }}</span>
                of
                <span class="fw-semibold text-primary">{{ $paginator->total() }}</span>
                results
                @if($paginator->lastPage() > 1)
                    (Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }})
                @endif
            </p>
        </div>

        <!-- Pagination Controls -->
        <div class="pagination-wrapper">
            <ul class="pagination mb-0">
                {{-- Previous Button --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="Previous page">
                        <span class="page-link" tabindex="-1">
                            <i class="fas fa-chevron-left"></i>
                            <span class="d-none d-sm-inline ms-1">Previous</span>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">
                            <i class="fas fa-chevron-left"></i>
                            <span class="d-none d-sm-inline ms-1">Previous</span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">
                                <i class="fas fa-ellipsis-h"></i>
                            </span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Button --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">
                            <span class="d-none d-sm-inline me-1">Next</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="Next page">
                        <span class="page-link" tabindex="-1">
                            <span class="d-none d-sm-inline me-1">Next</span>
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
