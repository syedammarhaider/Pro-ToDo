@extends('layouts.app')

@section('title', 'Create New Todo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card glass-effect">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i> Create New Todo
                </h4>
            </div>
            
            <div class="card-body">
                <form action="{{ route('todos.store') }}" method="POST" id="todoForm">
                    @csrf
                    
                    <!-- Title Field - Title ka field -->
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-heading me-1"></i> Title *
                        </label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               placeholder="Enter todo title" 
                               required
                               maxlength="255">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Enter a clear and concise title</small>
                    </div>
                    
                    <!-- Description Field - Description ka field -->
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-1"></i> Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Enter detailed description (optional)">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Add details, steps, or notes</small>
                    </div>
                    
                    <div class="row">
                        <!-- Priority Field - Priority ka field -->
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">
                                <i class="fas fa-exclamation-circle me-1"></i> Priority *
                            </label>
                            <select class="form-select @error('priority') is-invalid @enderror" 
                                    id="priority" 
                                    name="priority" 
                                    required>
                                <option value="">Select Priority</option>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>
                                    Low Priority
                                </option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>
                                    Medium Priority
                                </option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>
                                    High Priority
                                </option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Due Date Field - Due date ka field -->
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">
                                <i class="far fa-calendar-alt me-1"></i> Due Date
                            </label>
                            <input type="date" 
                                   class="form-control @error('due_date') is-invalid @enderror" 
                                   id="due_date" 
                                   name="due_date" 
                                   value="{{ old('due_date') }}"
                                   min="{{ date('Y-m-d') }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Optional due date</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Category Field - Category ka field -->
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">
                                <i class="fas fa-folder me-1"></i> Category
                            </label>
                            <input type="text" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category') }}" 
                                   placeholder="e.g., Work, Personal, Shopping"
                                   maxlength="50">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Optional category for organization</small>
                        </div>
                    </div>
                    
                    <!-- Form Buttons - Form ke buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('todos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Todo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Form validation - Form validation
    document.getElementById('todoForm').addEventListener('submit', function(e) {
        let title = document.getElementById('title').value.trim();
        if(title.length < 3) {
            alert('Title must be at least 3 characters long.');
            e.preventDefault();
        }
    });
    
    // Set minimum date to today - Aaj ki date minimum rakhna
    document.getElementById('due_date').min = new Date().toISOString().split('T')[0];
</script>
@endsection