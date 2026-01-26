@extends('layouts.app')

@section('title', $todo->title)

@section('styles')
<style>
:root {
    --bg-main: #0f1a4d;
    --text-primary: #ffffff;
    --text-secondary: #b2b9d1;
    --accent-success: #28a745;
    --accent-warning: #ffc107;
    --accent-danger: #dc3545;
    --accent-info: #17a2b8;
    --glass-bg: rgba(9, 18, 54, 0.75);
    --glass-border: rgba(255, 255, 255, 0.1);
}

body {
    background: var(--bg-main);
    color: var(--text-primary);
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
}

.glass-effect {
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border: 1.5px solid var(--glass-border);
    border-radius: 20px;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
}

.card-header {
    font-weight: 700;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #000;
    background: linear-gradient(135deg, var(--accent-warning), #ffca2c);
    border-radius: 20px 20px 0 0;
}

.card-header i {
    font-size: 1.5rem;
}

.card-body {
    color: var(--text-primary);
    padding: 1.5rem;
}

h4.text-white {
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

small.text-white {
    font-size: 0.9rem;
    opacity: 0.75;
}

.badge {
    font-weight: 700;
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    text-transform: capitalize;
    white-space: nowrap;
}

.badge.bg-success {
    background-color: var(--accent-success);
    color: #fff;
}

.badge.bg-warning {
    background-color: var(--accent-warning);
    color: #000;
}

.badge.bg-danger {
    background-color: var(--accent-danger);
    color: #fff;
}

.badge.bg-info {
    background-color: var(--accent-info);
    color: #fff;
}

.text-black {
    color: #000 !important;
}

.border-secondary {
    border-color: rgba(0,0,0,0.15) !important;
}

.card-body .d-flex.justify-content-between {
    padding: 0.5rem 0;
}

p {
    font-size: 1rem;
    line-height: 1.5;
    white-space: pre-wrap;
    color: var(--text-primary);
}

.text-muted {
    color: rgba(255,255,255,0.5);
    font-size: 1rem;
}

.btn {
    border-radius: 0.375rem;
    font-weight: 600;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn i {
    font-size: 1.1rem;
}

.btn-success {
    background: linear-gradient(135deg, var(--accent-success), #28a745cc);
    border: none;
    color: white;
    box-shadow: 0 6px 12px rgba(40,167,69,0.4);
}

.btn-success:hover {
    filter: brightness(1.1);
    box-shadow: 0 10px 25px rgba(40,167,69,0.7);
    transform: translateY(-2px);
}

.btn-warning {
    background: linear-gradient(135deg, var(--accent-warning), #ffca2ccc);
    border: none;
    color: #000;
    box-shadow: 0 6px 12px rgba(255,193,7,0.4);
}

.btn-warning:hover {
    filter: brightness(1.1);
    box-shadow: 0 10px 25px rgba(255,193,7,0.7);
    transform: translateY(-2px);
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-info), #48caffcc);
    border: none;
    color: white;
    box-shadow: 0 6px 12px rgba(72,202,255,0.4);
}

.btn-primary:hover {
    filter: brightness(1.1);
    box-shadow: 0 10px 25px rgba(72,202,255,0.7);
    transform: translateY(-2px);
}

.btn-secondary {
    background: rgba(255,255,255,0.1);
    color: white;
    border: 1px solid rgba(255,255,255,0.3);
}

.btn-secondary:hover {
    background: rgba(255,255,255,0.2);
    color: var(--accent-info);
    border-color: var(--accent-info);
}

.btn-danger {
    background: linear-gradient(135deg, var(--accent-danger), #ff758fcc);
    border: none;
    color: white;
    box-shadow: 0 6px 12px rgba(220,53,69,0.4);
}

.btn-danger:hover {
    filter: brightness(1.1);
    box-shadow: 0 10px 25px rgba(220,53,69,0.7);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 767.98px) {
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .card-header {
        font-size: 1.1rem;
        gap: 0.25rem;
    }
    h4.text-white {
        font-size: 1.25rem;
    }
    .btn {
        font-size: 0.9rem;
        min-width: 100px;
        padding: 0.4rem 0.8rem;
    }
    p, small {
        font-size: 0.9rem;
    }
}
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card glass-effect shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center"
                 style="border-left: 5px solid var(--{{ $todo->getPriorityColor() }})">
                <div>
                    <h4 class="text-white mb-0 d-flex align-items-center">
                        @if($todo->completed)
                            <i class="fas fa-check-circle text-success me-2"></i>
                        @endif
                        {{ $todo->title }}
                    </h4>
                    <small class="text-white">
                        Created {{ $todo->created_at->diffForHumans() }}
                    </small>
                </div>
                <div>
                    <span class="badge bg-{{ $todo->getPriorityColor() }}">
                        {{ ucfirst($todo->priority) }} Priority
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card mb-3 bg-transparent border-0">
                            <div class="card-body p-0">
                                <h6 class="text-white mb-3 d-flex align-items-center">
                                    <i class="fas fa-info-circle me-2 text-info"></i> Details
                                </h6>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <span class="text-white">Status:</span>
                                        <span class="badge bg-{{ $todo->completed ? 'success' : ($todo->isOverdue() ? 'danger' : 'warning') }} px-3 py-2">
                                            {{ $todo->getStatusText() }}
                                        </span>
                                    </div>
                                </div>
                                @if($todo->category)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <span class="text-white">Category:</span>
                                        <span class="badge bg-info px-3 py-2">{{ $todo->category }}</span>
                                    </div>
                                </div>
                                @endif
                                @if($todo->due_date)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <span class="text-white">Due Date:</span>
                                        <span class="text-white">{{ $todo->due_date->format('F d, Y') }}
                                            @if($todo->isOverdue())
                                                <span class="badge bg-danger ms-2">Overdue</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @endif
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span class="text-white">Last Updated:</span>
                                        <span class="text-white">{{ $todo->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 bg-transparent border-0">
                    <div class="card-header bg-info text-white d-flex align-items-center">
                        <i class="fas fa-align-left me-2"></i> Description
                    </div>
                    <div class="card-body p-3 bg-transparent">
                        @if($todo->description)
                            <p style="white-space: pre-wrap;">{{ $todo->description }}</p>
                        @else
                            <p class="text-muted">No description provided</p>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap gap-3">
                    <div>
                        @if(!$todo->completed)
                            <form action="{{ route('todos.complete', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success d-flex align-items-center">
                                    <i class="fas fa-check me-1"></i> Mark Complete
                                </button>
                            </form>
                        @else
                            <form action="{{ route('todos.incomplete', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-undo me-1"></i> Mark Incomplete
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary d-flex align-items-center" style="margin-right: 0.5rem;">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('todos.index') }}" class="btn btn-secondary d-flex align-items-center" style="margin-right: 0.5rem;">
                            <i class="fas fa-list me-1"></i> All Todos
                        </a>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger d-flex align-items-center" onclick="return confirm('Delete this todo?')">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection