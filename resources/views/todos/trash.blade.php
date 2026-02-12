@extends('layouts.app')

@section('title', 'Trashed Tasks - PRO TODO')

@section('content')
<div class="trash-container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 class="trash-title mb-2">
                <i class="fas fa-trash-alt me-3"></i> Trashed Tasks
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-2"></i> 
                Tasks are automatically deleted after 30 days in trash
            </p>
        </div>
        <div>
            <a href="{{ route('todos.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-left me-2"></i> Back to Tasks
            </a>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card glass-effect border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-trash-alt fa-2x text-danger"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Trashed</h6>
                            <h3 class="mb-0 fw-bold">{{ $trashedTodos->total() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card glass-effect border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-clock fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Auto Deletion</h6>
                            <h3 class="mb-0 fw-bold">30 Days</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Trashed Items -->
    <div class="card glass-effect border-0">
        <div class="card-body p-0">
            @if($trashedTodos->count() > 0)
                <div class="list-group list-group-flush bg-transparent">
                    @foreach($trashedTodos as $todo)
                        <div class="trash-item list-group-item bg-transparent border-bottom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <h5 class="fw-bold mb-0">{{ $todo->title }}</h5>
                                        <span class="badge bg-{{ $todo->priority }} bg-opacity-25 text-{{ $todo->priority }} px-3 py-2">
                                            {{ ucfirst($todo->priority) }}
                                        </span>
                                    </div>
                                    
                                    @if($todo->description)
                                        <p class="text-muted mb-2">{{ Str::limit($todo->description, 100) }}</p>
                                    @endif
                                    
                                    <div class="d-flex flex-wrap gap-3 small">
                                        @if($todo->category)
                                            <span class="text-muted">
                                                <i class="fas fa-tag me-1"></i> {{ $todo->category }}
                                            </span>
                                        @endif
                                        
                                        @if($todo->due_date)
                                            <span class="text-muted">
                                                <i class="far fa-calendar me-1"></i> Due: {{ $todo->due_date->format('M d, Y') }}
                                            </span>
                                        @endif
                                        
                                        <span class="text-danger">
                                            <i class="far fa-trash-alt me-1"></i> 
                                            Deleted: {{ $todo->deleted_at->diffForHumans() }}
                                        </span>
                                        
                                        <span class="text-muted">
                                            <i class="far fa-clock me-1"></i>
                                            Auto-delete: {{ $todo->deleted_at->addDays(30)->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <form action="{{ route('todos.restore', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success" 
                                                onclick="return confirm('Restore this task?')"
                                                title="Restore task">
                                            <i class="fas fa-trash-restore me-1"></i>
                                            <span class="d-none d-md-inline">Restore</span>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('todos.force-delete', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                onclick="return confirm('Permanently delete this task? This cannot be undone.')"
                                                title="Permanently delete">
                                            <i class="fas fa-times-circle me-1"></i>
                                            <span class="d-none d-md-inline">Delete Forever</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($trashedTodos->hasPages())
                    <div class="card-footer bg-transparent border-0 py-3">
                        {{ $trashedTodos->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="empty-state-micro py-5">
                    <div class="empty-icon-micro mb-4">
                        <i class="fas fa-trash-restore fa-4x text-muted"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-2">Trash is Empty</h3>
                    <p class="text-muted mb-4">No tasks have been moved to trash yet.</p>
                    <a href="{{ route('todos.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i> Back to Tasks
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
