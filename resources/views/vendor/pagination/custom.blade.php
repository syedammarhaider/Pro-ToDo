@if ($paginator->hasPages())
    <nav aria-label="Pagination navigation" class="pagination-nav">
        <ul class="pagination justify-content-center mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- First Page --}}
            @if ($paginator->currentPage() > 3)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>
                
                {{-- Dots if needed --}}
                @if ($paginator->currentPage() > 4)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            {{-- First 3 Pages or Current Page Area --}}
            @php
                $start = max(1, $paginator->currentPage() - 1);
                $end = min($paginator->lastPage(), $start + 2);
                
                if ($paginator->currentPage() <= 3) {
                    $start = 1;
                    $end = min(3, $paginator->lastPage());
                }
                
                if ($paginator->currentPage() > $paginator->lastPage() - 3) {
                    $start = max(1, $paginator->lastPage() - 2);
                    $end = $paginator->lastPage();
                }
            @endphp

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Last 3 Pages --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
                
                {{-- Show last 3 pages --}}
                @for ($i = max($paginator->lastPage() - 2, $end + 1); $i <= $paginator->lastPage(); $i++)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
                @endfor
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
        
        {{-- Page Info --}}
        <div class="pagination-info text-center mt-2 d-none d-md-block">
            <small class="text-muted">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
            </small>
        </div>
    </nav>

    <style>
    /* Ultra Professional Pagination Styles */
    .pagination-nav {
        margin: 0;
        padding: 0;
    }
    
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 0.25rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .page-item {
        display: flex;
    }
    
    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        margin: 0;
        border: 2px solid var(--bs-border-color);
        border-radius: 8px;
        background-color: var(--bs-card-bg);
        color: var(--bs-body-color);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .page-link:hover {
        background-color: var(--bs-btn-primary-bg);
        border-color: var(--bs-btn-primary-bg);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    
    .page-item.active .page-link {
        background-color: var(--bs-btn-primary-bg);
        border-color: var(--bs-btn-primary-bg);
        color: #ffffff;
        font-weight: 700;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    }
    
    .page-item.disabled .page-link {
        background-color: transparent;
        border-color: var(--bs-border-color);
        color: var(--bs-text-muted);
        cursor: not-allowed;
        opacity: 0.6;
    }
    
    .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
    }
    
    /* Dark Mode Enhancements */
    [data-theme="dark"] .page-link {
        background-color: #1e293b;
        border-color: #334155;
        color: #f8fafc;
    }
    
    [data-theme="dark"] .page-link:hover {
        background-color: #6366f1;
        border-color: #6366f1;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }
    
    [data-theme="dark"] .page-item.active .page-link {
        background-color: #6366f1;
        border-color: #6366f1;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.5);
    }
    
    [data-theme="dark"] .page-item.disabled .page-link {
        background-color: transparent;
        border-color: #334155;
        color: #64748b;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .pagination {
            gap: 0.15rem;
        }
        
        .page-link {
            min-width: 35px;
            height: 35px;
            padding: 0 8px;
            font-size: 0.85rem;
            border-width: 1px;
        }
        
        .page-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
        }
        
        .page-item.active .page-link {
            transform: scale(1.02);
        }
    }
    
    @media (max-width: 576px) {
        .pagination {
            gap: 0.1rem;
        }
        
        .page-link {
            min-width: 32px;
            height: 32px;
            padding: 0 6px;
            font-size: 0.8rem;
            border-radius: 6px;
        }
        
        /* Hide some page numbers on very small screens */
        .page-item:nth-child(n+4):nth-child(-n+{{ $paginator->lastPage() - 3 }}):not(.active):not(:first-child):not(:last-child) {
            display: none;
        }
        
        /* Always show first, last, current, and adjacent pages */
        .page-item:first-child,
        .page-item:last-child,
        .page-item.active,
        .page-item.active + .page-item,
        .page-item.active - .page-item {
            display: flex !important;
        }
    }
    
    /* Loading Animation */
    .page-link::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.3s ease, height 0.3s ease;
    }
    
    .page-link:hover::before {
        width: 100%;
        height: 100%;
    }
    
    /* Focus Styles */
    .page-link:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25);
    }
    
    [data-theme="dark"] .page-link:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
    }
    </style>
@endif
