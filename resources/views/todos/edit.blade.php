@extends('layouts.app')

@section('title', 'Edit Todo')

@section('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body {
    background: var(--bg-main, #0f1a4d);
    font-family: 'Inter', sans-serif;
    color: #fff;
    margin: 0;
    padding: 0;
}

.glass-effect {
    background: rgba(9, 18, 54, 0.75);
    backdrop-filter: blur(20px);
    border: 1.5px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.card-header.bg-warning {
    background: linear-gradient(135deg, #ffc107, #ffca2c);
    color: #000;
    font-weight: 600;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-body {
    color: #fff;
}

.form-label {
    color: #e0e0e0;
    font-weight: 600;
}

.form-control, .form-select {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #fff;
    border-radius: 12px;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    width: 100%;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.form-control:focus, .form-select:focus {
    border-color: #00d2ff;
    background: rgba(255, 255, 255, 0.15);
    outline: none;
    color: #fff;
    box-shadow: 0 0 8px #00d2ff;
}

.form-check-label {
    color: #fff;
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
    background: linear-gradient(135deg, #007bff, #00d2ff);
    border: none;
    color: white;
    box-shadow: 0 6px 12px rgba(0, 210, 255, 0.5);
}

.btn-primary:hover {
    filter: brightness(1.1);
    box-shadow: 0 10px 25px rgba(0, 210, 255, 0.75);
    transform: translateY(-2px);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #00d2ff;
    border-color: #00d2ff;
}

.btn-info {
    background: linear-gradient(135deg, #17a2b8, #48caff);
    border: none;
    color: white;
}

.btn-info:hover {
    filter: brightness(1.1);
    box-shadow: 0 8px 20px rgba(72, 202, 255, 0.7);
    transform: translateY(-2px);
}

.btn-danger {
    background: linear-gradient(135deg, #ff4b5c, #ff758f);
    border: none;
    color: white;
    box-shadow: 0 6px 12px rgba(255, 75, 92, 0.5);
}

.btn-danger:hover {
    filter: brightness(1.1);
    box-shadow: 0 10px 25px rgba(255, 75, 92, 0.75);
    transform: translateY(-2px);
}

.invalid-feedback {
    font-size: 0.875rem;
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
    .d-flex.justify-content-between.mt-4 > div {
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 1rem;
    }
}

</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card glass-effect shadow-lg">
            <div class="card-header bg-warning d-flex align-items-center">
                <i class="fas fa-edit me-2"></i>
                <h4 class="mb-0 flex-grow-1 text-truncate">Edit Todo: {{ $todo->title }}</h4>
            </div>
            
            <div class="card-body">
                <form action="{{ route('todos.update', $todo) }}" method="POST" id="editForm" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $todo->title) }}" 
                               required 
                               autocomplete="off"
                               autofocus>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4"
                                  autocomplete="off"
                                  >{{ old('description', $todo->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="priority" class="form-label">Priority *</label>
                            <select class="form-select @error('priority') is-invalid @enderror" 
                                    id="priority" 
                                    name="priority" 
                                    required>
                                <option value="low" {{ old('priority', $todo->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', $todo->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority', $todo->priority) == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 col-md-6 d-flex align-items-center">
                            <div class="form-check mt-3 mt-md-0">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="completed" 
                                       name="completed" 
                                       value="1" 
                                       {{ old('completed', $todo->completed) ? 'checked' : '' }}>
                                <label class="form-check-label" for="completed">
                                    Mark as Completed
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-12 col-md-6">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" 
                                   class="form-control @error('due_date') is-invalid @enderror" 
                                   id="due_date" 
                                   name="due_date" 
                                   value="{{ old('due_date', $todo->due_date ? $todo->due_date->format('Y-m-d') : '') }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category', $todo->category) }}"
                                   autocomplete="off">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('todos.index') }}" class="btn btn-secondary d-flex align-items-center">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <a href="{{ route('todos.show', $todo) }}" class="btn btn-info d-flex align-items-center">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="fas fa-save me-1"></i> Update Todo
                            </button>
                        </div>
                    </div>
                </form>
                
                <hr class="my-4" />
                
                <div class="mt-3">
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this todo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger d-flex align-items-center">
                            <i class="fas fa-trash me-1"></i> Delete Todo
                        </button>
                        <small class="text-muted ms-2">This action cannot be undone</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection