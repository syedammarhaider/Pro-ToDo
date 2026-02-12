@extends('layouts.app')

@section('title', 'Edit Task - ' . $todo->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card glass-effect shadow-lg border-0">
            <div class="card-header bg-gradient-warning border-0 py-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2">
                            <i class="fas fa-edit fa-2x text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3 class="mb-0 text-white fw-bold">Edit Task</h3>
                        <p class="mb-0 text-white-50 small">Update task details</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('todos.update', $todo) }}" method="POST" id="editForm" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <!-- Title Field -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">
                            <i class="fas fa-heading text-primary me-1"></i> Task Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $todo->title) }}" 
                               required
                               maxlength="255"
                               autocomplete="off"
                               autofocus>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text d-flex justify-content-between">
                            <span><i class="fas fa-info-circle me-1"></i> 3-255 characters</span>
                            <span id="charCount">{{ strlen($todo->title) }}/255</span>
                        </div>
                    </div>
                    
                    <!-- Description Field -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">
                            <i class="fas fa-align-left text-info me-1"></i> Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Add details, steps, or notes (optional)"
                                  autocomplete="off">{{ old('description', $todo->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Priority & Due Date Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="priority" class="form-label fw-semibold">
                                <i class="fas fa-exclamation-triangle text-warning me-1"></i> Priority <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('priority') is-invalid @enderror" 
                                    id="priority" 
                                    name="priority" 
                                    required>
                                <option value="low" {{ old('priority', $todo->priority) == 'low' ? 'selected' : '' }} class="text-success">
                                    🟢 Low - Can wait
                                </option>
                                <option value="medium" {{ old('priority', $todo->priority) == 'medium' ? 'selected' : '' }} class="text-warning">
                                    🟡 Medium - Important
                                </option>
                                <option value="high" {{ old('priority', $todo->priority) == 'high' ? 'selected' : '' }} class="text-danger">
                                    🔴 High - Urgent
                                </option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="due_date" class="form-label fw-semibold">
                                <i class="far fa-calendar-alt text-primary me-1"></i> Due Date
                            </label>
                            <input type="date" 
                                   class="form-control @error('due_date') is-invalid @enderror" 
                                   id="due_date" 
                                   name="due_date" 
                                   value="{{ old('due_date', $todo->due_date ? $todo->due_date->format('Y-m-d') : '') }}"
                                   min="{{ date('Y-m-d') }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Category & Status Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="category" class="form-label fw-semibold">
                                <i class="fas fa-folder text-secondary me-1"></i> Category
                            </label>
                            <input type="text" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category', $todo->category) }}" 
                                   placeholder="e.g., Work, Personal"
                                   maxlength="50"
                                   autocomplete="off"
                                   list="categorySuggestions">
                            <datalist id="categorySuggestions">
                                <option value="Work">
                                <option value="Personal">
                                <option value="Shopping">
                                <option value="Health">
                                <option value="Finance">
                            </datalist>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold d-block">
                                <i class="fas fa-check-circle text-success me-1"></i> Status
                            </label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="completed" 
                                       name="completed" 
                                       value="1" 
                                       {{ old('completed', $todo->completed) ? 'checked' : '' }}
                                       style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-normal" for="completed">
                                    {{ $todo->completed ? 'Completed' : 'Mark as Completed' }}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metadata -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <div class="bg-light bg-opacity-10 rounded-3 p-3">
                                <div class="d-flex flex-wrap gap-3 small">
                                    <span>
                                        <i class="far fa-clock text-muted me-1"></i>
                                        Created: {{ $todo->created_at->format('M d, Y') }}
                                    </span>
                                    <span>
                                        <i class="far fa-edit text-muted me-1"></i>
                                        Last updated: {{ $todo->updated_at->diffForHumans() }}
                                    </span>
                                    @if($todo->completed)
                                        <span class="text-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Completed
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                        <a href="{{ route('todos.show', $todo) }}" class="btn btn-outline-info">
                            <i class="fas fa-eye me-2"></i> View Details
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                <i class="fas fa-save me-2"></i> Update Task
                                <span class="spinner-border spinner-border-sm d-none" id="submitSpinner"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Delete Section -->
        <div class="card glass-effect border-0 mt-4">
            <div class="card-body p-4">
                <h5 class="text-danger fw-bold mb-3">
                    <i class="fas fa-trash-alt me-2"></i> Danger Zone
                </h5>
                <p class="text-muted small mb-3">Once you delete a task, it's moved to trash. You can restore it within 30 days.</p>
                
                <form action="{{ route('todos.destroy', $todo) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this task? It will be moved to trash.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-trash me-2"></i> Move to Trash
                    </button>
                    <small class="text-muted ms-2">This action can be undone</small>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function() {
        'use strict';
        
        // Character counter
        const titleInput = document.getElementById('title');
        const charCount = document.getElementById('charCount');
        
        if (titleInput && charCount) {
            titleInput.addEventListener('input', function() {
                charCount.textContent = `${this.value.length}/255`;
            });
        }
        
        // Set minimum date for due_date
        const dueDateInput = document.getElementById('due_date');
        if (dueDateInput) {
            const today = new Date().toISOString().split('T')[0];
            dueDateInput.setAttribute('min', today);
        }
        
        // Form validation
        const form = document.getElementById('editForm');
        const submitBtn = document.getElementById('submitBtn');
        const spinner = document.getElementById('submitSpinner');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                const title = titleInput?.value.trim();
                
                if (!title || title.length < 3) {
                    e.preventDefault();
                    if (typeof window.showMessage === 'function') {
                        window.showMessage('Title must be at least 3 characters long', 'warning');
                    } else {
                        alert('Title must be at least 3 characters long');
                    }
                    titleInput?.focus();
                    return;
                }
                
                // Show loading state
                if (submitBtn && spinner) {
                    submitBtn.disabled = true;
                    spinner.classList.remove('d-none');
                }
            });
        }
    })();
</script>
@endpush