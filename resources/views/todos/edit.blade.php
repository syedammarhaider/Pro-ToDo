@extends('layouts.app')



@section('title', 'Edit Todo')



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