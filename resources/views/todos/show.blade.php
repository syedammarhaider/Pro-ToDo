@extends('layouts.app')

@section('title', $todo->title . ' - Task Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card glass-effect shadow-lg border-0">
            <!-- Header -->
            <div class="card-header bg-gradient-{{ $todo->getPriorityColor() }} border-0 py-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-white bg-opacity-20 rounded-circle p-2">
                                <i class="fas {{ $todo->completed ? 'fa-check-circle' : 'fa-clock' }} fa-2x text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1 text-white fw-bold">{{ $todo->title }}</h3>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge bg-white text-{{ $todo->getPriorityColor() }} px-3 py-2">
                                    <i class="fas fa-flag me-1"></i> {{ ucfirst($todo->priority) }} Priority
                                </span>
                                <span class="text-white-50 small">
                                    <i class="far fa-calendar me-1"></i> Created {{ $todo->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <span class="badge bg-{{ $todo->completed ? 'success' : ($todo->isOverdue() ? 'danger' : 'warning') }} px-4 py-2 fs-6">
                        <i class="fas {{ $todo->completed ? 'fa-check-circle' : ($todo->isOverdue() ? 'fa-exclamation-triangle' : 'fa-hourglass-half') }} me-1"></i>
                        {{ $todo->getStatusText() }}
                    </span>
                </div>
            </div>
            
            <!-- Body -->
            <div class="card-body p-4">
                <!-- Details Grid -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="bg-light bg-opacity-10 rounded-3 p-3">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-info-circle text-info me-2"></i> Task Information
                            </h6>
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="ps-0 text-muted">Status:</td>
                                    <td class="fw-semibold">
                                        @if($todo->completed)
                                            <span class="text-success">✅ Completed</span>
                                        @elseif($todo->isOverdue())
                                            <span class="text-danger">⚠️ Overdue</span>
                                        @else
                                            <span class="text-warning">🟡 In Progress</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0 text-muted">Priority:</td>
                                    <td>
                                        <span class="badge bg-{{ $todo->getPriorityColor() }} px-3 py-2">
                                            {{ ucfirst($todo->priority) }}
                                        </span>
                                    </td>
                                </tr>
                                @if($todo->category)
                                <tr>
                                    <td class="ps-0 text-muted">Category:</td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-25 text-info px-3 py-2">
                                            <i class="fas fa-tag me-1"></i> {{ $todo->category }}
                                        </span>
                                    </td>
                                </tr>
                                @endif
                                @if($todo->due_date)
                                <tr>
                                    <td class="ps-0 text-muted">Due Date:</td>
                                    <td class="fw-semibold {{ $todo->isOverdue() && !$todo->completed ? 'text-danger' : '' }}">
                                        <i class="far fa-calendar me-1"></i> {{ $todo->due_date->format('F d, Y') }}
                                        @if($todo->isOverdue() && !$todo->completed)
                                            <span class="badge bg-danger ms-2">Overdue</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="ps-0 text-muted">Last Updated:</td>
                                    <td class="text-muted">
                                        <i class="far fa-edit me-1"></i> {{ $todo->updated_at->diffForHumans() }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="bg-light bg-opacity-10 rounded-3 p-3">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-align-left text-info me-2"></i> Description
                            </h6>
                            @if($todo->description)
                                <div class="p-3 bg-dark bg-opacity-5 rounded-3">
                                    <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">{{ $todo->description }}</p>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No description provided</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Timeline -->
                <div class="mt-4 pt-3 border-top">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-history text-info me-2"></i> Timeline
                    </h6>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-plus-circle text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Created</small>
                                <strong>{{ $todo->created_at->format('M d, Y - h:i A') }}</strong>
                            </div>
                        </div>
                        
                        @if($todo->completed)
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Completed</small>
                                <strong>{{ $todo->updated_at->format('M d, Y - h:i A') }}</strong>
                            </div>
                        </div>
                        @endif
                        
                        @if($todo->deleted_at)
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-trash text-danger"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Deleted</small>
                                <strong>{{ $todo->deleted_at->format('M d, Y - h:i A') }}</strong>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Footer Actions -->
            <div class="card-footer bg-transparent border-0 p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex gap-2">
                        @if(!$todo->completed)
                            <form action="{{ route('todos.complete', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check me-2"></i> Mark Complete
                                </button>
                            </form>
                        @else
                            <form action="{{ route('todos.incomplete', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning px-4">
                                    <i class="fas fa-undo me-2"></i> Mark Incomplete
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit me-2"></i> Edit Task
                        </a>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i> All Tasks
                        </a>
                        
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this task? It will be moved to trash.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-2"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
