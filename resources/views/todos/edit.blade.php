@extends('layouts.app')

@section('title', 'Edit Todo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card glass-effect">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i> Edit Todo: {{ $todo->title }}
                </h4>
            </div>
            
            <div class="card-body">
                <form action="{{ route('todos.update', $todo) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Title Field - Title ka field -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $todo->title) }}" 
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Description Field - Description ka field -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4">{{ old('description', $todo->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <!-- Priority Field - Priority ka field -->
                        <div class="col-md-6 mb-3">
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
                        
                        <!-- Completed Status - Completion status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check">
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
                    
                    <div class="row">
                        <!-- Due Date Field - Due date ka field -->
                        <div class="col-md-6 mb-3">
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
                        
                        <!-- Category Field - Category ka field -->
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category', $todo->category) }}">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Tags Field - Tags ka field -->
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" 
                               class="form-control @error('tags') is-invalid @enderror" 
                               id="tags" 
                               name="tags" 
                               value="{{ old('tags', $todo->tags ? implode(',', $todo->tags) : '') }}" 
                               placeholder="Separate with commas">
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Form Buttons - Form ke buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <a href="{{ route('todos.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <a href="{{ route('todos.show', $todo) }}" class="btn btn-info">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Todo
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Delete Form - Delete karne ka form -->
                <hr>
                <div class="mt-3">
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this todo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
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