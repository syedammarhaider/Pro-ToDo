@extends('layouts.app')

@section('title', $todo->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card glass-effect">
            <div class="card-header d-flex justify-content-between align-items-center"
                 style="border-left: 5px solid var(--{{ $todo->getPriorityColor() }})">
                <div>
                    <h4 class="mb-0">
                        @if($todo->completed)
                            <i class="fas fa-check-circle text-success me-2"></i>
                        @endif
                        {{ $todo->title }}
                    </h4>
                    <small class="text-muted">
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
                                <h6><i class="fas fa-info-circle me-2"></i> Details</h6>
                                <div class="mb-2">
                                    <strong>Status:</strong>
                                    <span class="badge bg-{{ $todo->completed ? 'success' : ($todo->isOverdue() ? 'danger' : 'warning') }}">
                                        {{ $todo->getStatusText() }}
                                    </span>
                                </div>
                                @if($todo->category)
                                    <div class="mb-2">
                                        <strong>Category:</strong>
                                        <span class="badge bg-info">{{ $todo->category }}</span>
                                    </div>
                                @endif
                                @if($todo->due_date)
                                    <div class="mb-2">
                                        <strong>Due Date:</strong>
                                        <span class="{{ $todo->isOverdue() ? 'text-danger fw-bold' : '' }}">
                                            {{ $todo->due_date->format('F d, Y') }}
                                            @if($todo->isOverdue())
                                                <span class="badge bg-danger ms-1">Overdue</span>
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                <div>
                                    <strong>Last Updated:</strong>
                                    {{ $todo->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6><i class="fas fa-tags me-2"></i> Tags</h6>
                                @if($todo->tags && count($todo->tags) > 0)
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($todo->tags as $tag)
                                            <span class="badge bg-secondary">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted mb-0">No tags added</p>
                                @endif
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
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('todos.index') }}" class="btn btn-secondary">
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