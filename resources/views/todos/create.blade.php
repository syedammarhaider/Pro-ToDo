@extends('layouts.app')

@section('title', 'Create New Task - PRO TODO')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card glass-effect shadow-lg border-0">
            <div class="card-header bg-gradient-primary border-0 py-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2">
                            <i class="fas fa-plus-circle fa-2x text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3 class="mb-0 text-white fw-bold">Create New Task</h3>
                        <p class="mb-0 text-white-50 small">Add a new task to your list</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('todos.store') }}" method="POST" id="todoForm" novalidate>
                    @csrf
                    
                    <!-- Title Field -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">
                            <i class="fas fa-heading text-primary me-1"></i> Task Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               placeholder="e.g., Complete project report" 
                               required
                               maxlength="255"
                               autocomplete="off"
                               autofocus>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text d-flex justify-content-between">
                            <span><i class="fas fa-info-circle me-1"></i> Clear and concise title (3-255 characters)</span>
                            <span id="charCount">0/255</span>
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
                                  autocomplete="off">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-lightbulb me-1"></i> Include specific details, deadlines, or requirements
                        </div>
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
                                <option value="" disabled {{ old('priority') ? '' : 'selected' }}>Select priority level</option>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }} class="text-success">
                                    🟢 Low - Can wait
                                </option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }} class="text-warning">
                                    🟡 Medium - Important
                                </option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }} class="text-danger">
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
                                   value="{{ old('due_date') }}"
                                   min="{{ date('Y-m-d') }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="far fa-clock me-1"></i> Leave empty for no deadline
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category Field -->
                    <div class="mb-4">
                        <label for="category" class="form-label fw-semibold">
                            <i class="fas fa-folder text-secondary me-1"></i> Category
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fas fa-tag"></i>
                            </span>
                            <input type="text" 
                                   class="form-control border-start-0 @error('category') is-invalid @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category') }}" 
                                   placeholder="e.g., Work, Personal, Shopping, Health"
                                   maxlength="50"
                                   autocomplete="off"
                                   list="categorySuggestions">
                            <datalist id="categorySuggestions">
                                <option value="Work">
                                <option value="Personal">
                                <option value="Shopping">
                                <option value="Health">
                                <option value="Finance">
                                <option value="Education">
                            </datalist>
                        </div>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-lightbulb me-1"></i> Organize tasks by category (max 50 characters)
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                        <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-warning" onclick="return confirm('Clear all fields?')">
                                <i class="fas fa-undo me-2"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                <i class="fas fa-save me-2"></i> Create Task
                                <span class="spinner-border spinner-border-sm d-none" id="submitSpinner"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Quick Tips -->
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <div class="alert alert-info bg-opacity-10 border-0 rounded-3 mb-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-lightbulb fs-4 text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold mb-1">✨ Quick Tips:</h6>
                            <ul class="small mb-0 ps-3">
                                <li>Use specific titles - "Call John about project" instead of "Call"</li>
                                <li>Add descriptions with step-by-step details</li>
                                <li>Set priorities to focus on what matters most</li>
                                <li>Use categories to group related tasks</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function() {
        'use strict';
        
        // Character counter for title
        const titleInput = document.getElementById('title');
        const charCount = document.getElementById('charCount');
        
        if (titleInput && charCount) {
            const updateCharCount = () => {
                const count = titleInput.value.length;
                charCount.textContent = `${count}/255`;
                charCount.style.color = count > 200 ? '#f59e0b' : count >= 255 ? '#ef4444' : '';
            };
            
            titleInput.addEventListener('input', updateCharCount);
            updateCharCount(); // Initial count
        }
        
        // Set minimum date for due_date
        const dueDateInput = document.getElementById('due_date');
        if (dueDateInput) {
            const today = new Date().toISOString().split('T')[0];
            dueDateInput.setAttribute('min', today);
        }
        
        // Form validation
        const form = document.getElementById('todoForm');
        const submitBtn = document.getElementById('submitBtn');
        const spinner = document.getElementById('submitSpinner');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                const title = titleInput?.value.trim();
                
                if (!title || title.length < 3) {
                    e.preventDefault();
                    showMessage('Title must be at least 3 characters long', 'warning');
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
        
        // Show message function
        function showMessage(text, type = 'info') {
            if (typeof window.showMessage === 'function') {
                window.showMessage(text, type, 3000);
            } else {
                alert(text);
            }
        }
        
        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert:not(.alert-permanent)').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    })();
</script>
@endpush