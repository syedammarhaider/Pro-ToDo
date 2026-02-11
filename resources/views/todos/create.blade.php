@extends('layouts.app')

@section('title', 'Create New Todo')

@section('styles')
<style>
:root {
    --bg-main: #0f1a4d;
    --text-primary: #ffffff;
    --text-secondary: #b2b9d1;
    --accent-pink: #eb00ff;
    --accent-blue: #007bff;
    --accent-cyan: #00d2ff;
    --accent-red: #ff4b5c;
    --accent-yellow: #ffc107;
    --accent-green: #00ff88;
    --glass-bg: rgba(9, 18, 54, 0.75);
    --glass-border: rgba(255, 255, 255, 0.1);
}

body {
    background: var(--bg-main);
    font-family: 'Inter', sans-serif;
    color: var(--text-primary);
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

.card-header.bg-primary {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 20px 20px 0 0;
}

.card-body {
    padding: 1.5rem;
    color: var(--text-primary);
}

.form-label {
    color: var(--text-primary);
    font-weight: 600;
}

.form-control, .form-select {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: var(--text-primary);
    border-radius: 12px;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    width: 100%;
}

.form-control::placeholder {
    color: rgba(255,255,255,0.6);
}

.form-control:focus, .form-select:focus {
    border-color: var(--accent-cyan);
    background: rgba(255,255,255,0.15);
    outline: none;
    box-shadow: 0 0 8px var(--accent-cyan);
    color: var(--text-primary);
}

.form-check-label {
    color: var(--text-primary);
}

.btn {
    border-radius: 12px;
    font-weight: 600;
    min-width: 120px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    padding: 0.5rem 1.25rem;
    transition: all 0.3s ease;
}

.btn i {
    font-size: 1.1rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
    border: none;
    color: white;
    box-shadow: 0 6px 12px rgba(0,210,255,0.5);
}

.btn-primary:hover {
    filter: brightness(1.1);
    box-shadow: 0 10px 25px rgba(0,210,255,0.7);
    transform: translateY(-2px);
}

.btn-secondary {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: var(--text-primary);
}

.btn-secondary:hover {
    background: rgba(255,255,255,0.2);
    color: var(--accent-cyan);
    border-color: var(--accent-cyan);
}

.invalid-feedback {
    font-size: 0.875rem;
    color: #ff6b6b;
}

@media (max-width: 767.98px) {
    .card-body {
        padding: 1rem !important;
    }
    .form-control, .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }
    .btn {
        font-size: 0.95rem;
        min-width: 100px;
        padding: 0.4rem 1rem;
    }
    .d-flex.justify-content-between.mt-4 {
        flex-direction: column;
        gap: 1rem;
    }
    .d-flex.justify-content-between.mt-4 > * {
        width: 100%;
        display: flex;
        justify-content: center;
    }
}
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-12">
        <div class="card glass-effect shadow-lg">
            <div class="card-header bg-primary">
                <i class="fas fa-plus-circle"></i> Create New Todo
            </div>
            <div class="card-body">
                <form action="{{ route('todos.store') }}" method="POST" id="todoForm" novalidate>
                    @csrf
                    
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
                               maxlength="255"
                               autocomplete="off">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Enter a clear and concise title</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-1"></i> Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Enter detailed description (optional)"
                                  autocomplete="off">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Add details, steps, or notes</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">
                                <i class="fas fa-exclamation-circle me-1"></i> Priority *
                            </label>
                            <select class="form-select @error('priority') is-invalid @enderror" 
                                    id="priority" 
                                    name="priority" 
                                    required>
                                <option value="">Select Priority</option>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low Priority</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium Priority</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High Priority</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
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
                                   maxlength="50"
                                   autocomplete="off">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Optional category for organization</small>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
                        <a href="{{ route('todos.index') }}" class="btn btn-secondary d-flex align-items-center">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center">
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
    document.getElementById('todoForm').addEventListener('submit', function(e) {
        const title = this.title.value.trim();
        if (title.length < 3) {
            alert('Title must be at least 3 characters long.');
            e.preventDefault();
            this.title.focus();
        }
    });
    document.getElementById('due_date').min = new Date().toISOString().split('T')[0];
</script>
@endsection