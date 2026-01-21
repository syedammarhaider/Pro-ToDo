@extends('layouts.app')

@section('title', $todo->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card glass-effect">
            <div class="card-header d-flex justify-content-between align-items-center"
                 style="border-left: 5px solid var(--{{ $todo->getPriorityColor() }})">
                <div>
                    <h4 class="text-white mb-0">
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
                <!-- Todo Meta Information - Todo ki meta information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="text-black mb-3"><i class="fas fa-info-circle me-2 text-info"></i> Details</h6>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <span class="text-black">Status:</span>
                                        <span class="badge bg-{{ $todo->completed ? 'success' : ($todo->isOverdue() ? 'danger' : 'warning') }} px-3 py-2">
                                            {{ $todo->getStatusText() }}
                                        </span>
                                    </div>
                                </div>
                                @if($todo->category)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <span class="text-black">Category:</span>
                                        <span class="badge bg-info px-3 py-2">{{ $todo->category }}</span>
                                    </div>
                                </div>
                                @endif
                                @if($todo->due_date)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <span class="text-black">Due Date:</span>
                                        <span class="text-black">{{ $todo->due_date->format('F d, Y') }}
                                            @if($todo->isOverdue())
                                                <span class="badge bg-danger ms-2">Overdue</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @endif
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span class="text-black">Last Updated:</span>
                                        <span class="text-black">{{ $todo->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Description Section - Description section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-align-left me-2"></i> Description</h6>
                    </div>
                    <div class="card-body">
                        @if($todo->description)
                            <p style="white-space: pre-wrap;">{{ $todo->description }}</p>
                        @else
                            <p class="text-muted">No description provided</p>
                        @endif
                    </div>
                </div>
                






                <!-- Action Buttons - Action buttons -->
                <div class="d-flex justify-content-between">
                    <div>
                        @if(!$todo->completed)
                            <form action="{{ route('todos.complete', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check me-1"></i> Mark Complete
                                </button>
                            </form>
                        @else
                            <form action="{{ route('todos.incomplete', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-undo me-1"></i> Mark Incomplete
                                </button>
                            </form>
                        @endif
                    </div>
                    





                    
                    <div class="btn-group">
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary" style="margin-right: 0.5rem; padding: 0.375rem 0.75rem; border-radius: 0.375rem;">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('todos.index') }}" class="btn btn-secondary" style="margin-right: 0.5rem; padding: 0.375rem 0.75rem; border-radius: 0.375rem;">
                            <i class="fas fa-list me-1"></i> All Todos
                        </a>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Delete this todo?')">
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