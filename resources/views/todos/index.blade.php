@extends('layouts.app')

@section('title', 'All Todos - Professional Todo App')

@section('content')
<div class="message-container" id="messageContainer" aria-live="assertive" aria-atomic="true" aria-relevant="additions"></div>

<!-- Quick Actions Bar -->
<div class="quick-actions-bar" id="quickActionsBar" role="toolbar" aria-label="Quick actions">
    <button class="quick-btn quick-btn-primary" data-tooltip="New Todo" aria-label="New Todo" onclick="window.location.href='{{ route('todos.create') }}'">
        <i class="fas fa-plus"></i>
    </button>
    <button class="quick-btn quick-btn-success" data-tooltip="Bulk Complete" aria-label="Bulk Complete selected todos" onclick="bulkComplete()">
        <i class="fas fa-check-double"></i>
    </button>
    <button class="quick-btn quick-btn-danger" data-tooltip="Bulk Delete" aria-label="Bulk Delete selected todos" onclick="bulkDelete()">
        <i class="fas fa-trash-can"></i>
    </button>
    <button class="quick-btn" data-tooltip="Toggle Filters" aria-label="Toggle Filters" onclick="toggleFilters()" style="background: linear-gradient(135deg, #8b5cf6, #ec4899)">
        <i class="fas fa-filter" id="filterIcon"></i>
    </button>
</div>

<div class="container-fluid px-2 px-md-3">
    <!-- Page Header -->
    <header class="page-header compact" id="pageHeader" role="banner">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="welcome-section d-flex align-items-center gap-3">
                <h1 tabindex="0" class="welcome-text" style="font-size: 1rem !important; margin: 0;">
                    Welcome, <span class="user-name">{{ Auth::user()->name }}</span>!
                </h1>
                <div class="todos-count-badge" style="font-size: 0.75rem !important; margin: 0;">
                    <div class="count-content d-flex align-items-center gap-2">
                        <span class="count-number">{{ $todos->total() }}</span>
                        <span class="count-label">Total Tasks</span>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2" style="display: flex !important;">
                <a href="{{ route('profile.show') }}" class="action-btn profile-btn" role="button" aria-label="View profile">
                    <i class="fas fa-user"></i>
                    <span class="btn-text">Profile</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="action-btn logout-btn" aria-label="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="btn-text">Logout</span>
                    </button>
                </form>
                <a href="{{ route('todos.create') }}" class="action-btn create-btn" role="button" aria-label="Create new todo">
                    <i class="fas fa-plus-circle"></i>
                    <span class="btn-text">New Task</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Stats Dashboard -->
    <section class="stats-dashboard mb-4" aria-label="Dashboard statistics">
        <div class="row g-3">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-stat="total">{{ $todos->total() }}</div>
                        <div class="stat-label">Total Tasks</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $todos->where('completed', true)->count() }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-stat="done">{{ $todos->total() > 0 ? round(($todos->where('completed', true)->count() / $todos->total()) * 100) : 0 }}%</div>
                        <div class="stat-label">Done</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $todos->where('completed', false)->count() }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-flag"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $todos->where('priority', 'high')->count() }}</div>
                        <div class="stat-label">High Priority</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $todos->whereNotNull('category')->unique('category')->count() }}</div>
                        <div class="stat-label">Categories</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-card glass-effect">
                    <div class="stat-icon">
                        <i class="fas fa-sync-alt" id="realTimeIcon"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" id="lastUpdate">Live</div>
                        <div class="stat-label">Real-time Updates</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section>
        <div class="card glass-effect filters-card" id="filtersCard">
            <div class="card-body p-3">
                <button class="filter-toggle-btn mb-3 w-100 d-flex align-items-center" aria-expanded="false" aria-controls="filterContent" onclick="toggleFilters()">
                    <i class="fas fa-sliders-h"></i>
                    <span class="fw-bold">Filters & Search</span>
                    <i class="fas fa-chevron-down ms-auto" id="filterArrow"></i>
                </button>
                
                <div id="filterContent" style="display:none;">
                    <form action="{{ route('todos.index') }}" method="GET" class="row g-2" role="search" aria-label="Todo search and filters">
                        <div class="col-12 col-md-6 col-lg-2">
                            <input type="search" name="search" class="form-control-micro" placeholder="🔍 Search tasks..." value="{{ request('search') }}" aria-label="Search todos">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="status" class="form-select-micro" aria-label="Filter by status">
                                <option value="">📊 All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>▶ Active</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>⏰ Overdue</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="priority" class="form-select-micro" aria-label="Filter by priority">
                                <option value="">🎯 All Priority</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="sort" class="form-select-micro" aria-label="Sort by">
                                <option value="">📅 Sort By</option>
                                <option value="due_date" {{ request('sort') == 'due_date' ? 'selected' : '' }}>📅 Due Date</option>
                                <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>🎯 Priority</option>
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>🕐 Created</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="direction" class="form-select-micro" aria-label="Sort direction">
                                <option value="">↕️ Order</option>
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>⬆️ Ascending</option>
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>⬇️ Descending</option>
                            </select>
                        </div>
                       
                        <div class="col-12 col-lg-2">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill" style="min-height:42px;" aria-label="Apply filters">
                                    <i class="fas fa-filter"></i>
                                    <span>Apply</span>
                                </button>
                                <a href="{{ route('todos.index') }}" class="btn btn-secondary flex-fill" style="min-height:42px;" aria-label="Reset filters">
                                    <i class="fas fa-rotate-right"></i>
                                    <span>Reset</span>
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2" aria-label="Bulk actions">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)" aria-label="Select or deselect all todos">
                            <label class="form-check-label" for="selectAll" style="font-size:0.875rem;">
                                Select All ({{ $todos->count() }})
                            </label>
                        </div>
                        <div class="d-flex gap-2">
                                                      <button type="button" class="btn btn-success btn-sm px-3" onclick="bulkComplete()" aria-label="Mark selected todos complete">
                                <i class="fas fa-check-double"></i>
                                <span class="d-none d-md-inline">Complete</span>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm px-3" onclick="bulkDelete()" aria-label="Delete selected todos">
                                <i class="fas fa-trash-can"></i>
                                <span class="d-none d-md-inline">Delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Todos Grid -->
    <section aria-live="polite" aria-relevant="additions removals" aria-label="List of todos">
        <div class="card glass-effect">
            <div class="card-body p-2 p-md-3">
                @if($todos->count() > 0)
                    <div class="todo-grid" id="todoGrid" role="list">
                        @foreach($todos as $todo)
                            <article class="todo-item-micro {{ $todo->priority }} {{ $todo->completed ? 'completed' : '' }}" 
                                     data-id="{{ $todo->id }}" 
                                     role="listitem" 
                                     tabindex="0" 
                                     aria-label="Todo: {{ $todo->title }}, Priority: {{ ucfirst($todo->priority) }}, Status: {{ $todo->completed ? 'Completed' : 'Active' }}" 
                                     onclick="toggleTodoSelect(this, event)">
                                
                                <div class="todo-header-micro">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="todo_ids[]" 
                                           value="{{ $todo->id }}" 
                                           aria-label="Select todo {{ $todo->title }}" 
                                           onclick="event.stopPropagation()">
                                    
                                    <h6 class="todo-title-micro text-truncate-2 {{ $todo->completed ? 'text-decoration-line-through opacity-75' : '' }}">
                                        @if(request('search'))
                                            @php
                                                $searchTerm = request('search');
                                                $highlightedTitle = preg_replace('/(' . preg_quote($searchTerm, '/') . ')/i', '<mark class="search-highlight">$1</mark>', $todo->title);
                                            @endphp
                                            {!! $highlightedTitle !!}
                                        @else
                                            {{ $todo->title }}
                                        @endif
                                    </h6>
                                    
                                    <div class="todo-actions-micro d-flex gap-1">
                                        @if(!$todo->completed)
                                            <form action="{{ route('todos.complete', $todo) }}" method="POST" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="button" class="btn-micro btn-success" title="Mark Complete" aria-pressed="false" onclick="handleTodoAction(this.closest('form'), 'complete', event);">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('todos.incomplete', $todo) }}" method="POST" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="button" class="btn-micro btn-warning" title="Mark Incomplete" aria-pressed="true" onclick="handleTodoAction(this.closest('form'), 'incomplete', event);">
                                                    <i class="fas fa-rotate-left"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="{{ route('todos.edit', $todo) }}" class="btn-micro btn-primary" title="Edit" onclick="event.stopPropagation()">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" onclick="event.stopPropagation()" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-micro btn-danger" onclick="handleTodoAction(this.closest('form'), 'delete', event);" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="todo-footer-micro">
                                    <div class="todo-meta-micro">
                                        <span class="priority-badge-micro">
                                            <i class="fas fa-flag"></i> {{ ucfirst($todo->priority) }}
                                        </span>
                                        @if($todo->category)
                                            <span class="category-tag-micro">
                                                <i class="fas fa-tag"></i> {{ $todo->category }}
                                            </span>
                                        @endif
                                        @if($todo->due_date)
                                            <span class="category-tag-micro {{ $todo->isOverdue() && !$todo->completed ? 'bg-danger text-white' : '' }}">
                                                <i class="far fa-calendar"></i> {{ $todo->due_date->format('M d') }}
                                                @if($todo->isOverdue() && !$todo->completed)
                                                    <i class="fas fa-exclamation-circle ms-1"></i>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('todos.show', $todo) }}" class="text-decoration-none small" onclick="event.stopPropagation()">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state-micro fade-in">
                        <div class="empty-icon-micro" aria-hidden="true">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-2">No tasks found</h3>
                        <p class="text-muted mb-4">Start organizing your tasks and boost productivity!</p>
                        <a href="{{ route('todos.create') }}" class="btn btn-primary btn-lg" role="button" aria-label="Create your first todo">
                            <i class="fas fa-plus-circle me-2"></i> Create First Task
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if($todos->hasPages())
                <div class="card-footer bg-transparent border-top py-3">
                    <nav aria-label="Pagination navigation">
                        {{ $todos->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
                    </nav>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    (() => {
        'use strict';
        
        let filtersVisible = false;
        const messageContainer = document.getElementById('messageContainer');
        const filterContent = document.getElementById('filterContent');
        const filterArrow = document.getElementById('filterArrow');
        const filtersCard = document.getElementById('filtersCard');
        const filterIcon = document.getElementById('filterIcon');

        // Toggle Filters
        window.toggleFilters = function() {
            filtersVisible = !filtersVisible;
            if (filterContent) {
                filterContent.style.display = filtersVisible ? 'block' : 'none';
            }
            if (filterArrow) {
                filterArrow.className = filtersVisible ? 'fas fa-chevron-up ms-auto' : 'fas fa-chevron-down ms-auto';
            }
            if (filtersCard) {
                filtersCard.classList.toggle('filters-collapsed', !filtersVisible);
            }
            if (filterIcon) {
                filterIcon.className = filtersVisible ? 'fas fa-times' : 'fas fa-filter';
            }
            showMessage(`Filters ${filtersVisible ? 'expanded' : 'collapsed'}`, 'info', 1500);
        };

        // Show Message
        window.showMessage = function(text, type = 'info', duration = 3000) {
            if (!messageContainer) return;
            
            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };
            
            const messageId = 'msg-' + Date.now();
            const message = document.createElement('div');
            message.className = `message message-${type} glass-effect`;
            message.id = messageId;
            message.innerHTML = `
                <div class="d-flex align-items-center gap-3">
                    <div class="message-icon fs-4">
                        <i class="${icons[type] || icons.info}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">${type.charAt(0).toUpperCase() + type.slice(1)}</div>
                        <div class="small">${text}</div>
                    </div>
                    <button class="btn-close" onclick="removeMessage('${messageId}')" aria-label="Close"></button>
                </div>
            `;
            
            messageContainer.appendChild(message);
            setTimeout(() => message.classList.add('show'), 10);
            
            if (duration > 0) {
                setTimeout(() => removeMessage(messageId), duration);
            }
        };

        // Remove Message
        window.removeMessage = function(id) {
            const message = document.getElementById(id);
            if (message) {
                message.classList.remove('show');
                setTimeout(() => message.remove(), 300);
            }
        };

        // Handle Todo Actions (Complete, Incomplete, Delete)
        window.handleTodoAction = async function(form, action, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            const todoItem = form.closest('.todo-item-micro');
            const todoId = todoItem?.dataset.id;
            
            if (!todoItem || !todoId) return;
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(new FormData(form))
                });
                
                if (response.ok) {
                    const result = await response.json();
                    showMessage(result.message || `${action} successful!`, 'success');
                    
                    if (action === 'delete') {
                        // Delete animation
                        todoItem.style.transition = 'all 0.3s';
                        todoItem.style.opacity = '0';
                        todoItem.style.transform = 'scale(0.8)';
                        
                        setTimeout(() => {
                            todoItem.remove();
                            updateTodoCount();
                            
                            if (document.querySelectorAll('.todo-item-micro').length === 0) {
                                location.reload(); // Reload to show empty state
                            }
                        }, 300);
                    } else {
                        // Update status instantly
                        const isCompleted = action === 'complete';
                        todoItem.classList.toggle('completed', isCompleted);
                        
                        const title = todoItem.querySelector('.todo-title-micro');
                        if (title) {
                            title.classList.toggle('text-decoration-line-through', isCompleted);
                            title.classList.toggle('opacity-75', isCompleted);
                        }
                        
                        // Update the action buttons
                        const actionsDiv = todoItem.querySelector('.todo-actions-micro');
                        if (actionsDiv) {
                            if (isCompleted) {
                                actionsDiv.innerHTML = `
                                    <form action="{{ route('todos.incomplete', ':id') }}" method="POST" onclick="event.stopPropagation()">
                                        @csrf
                                        <button type="button" class="btn-micro btn-warning" title="Mark Incomplete" onclick="handleTodoAction(this.closest('form'), 'incomplete', event);">
                                            <i class="fas fa-rotate-left"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('todos.edit', ':id') }}" class="btn-micro btn-primary" title="Edit" onclick="event.stopPropagation()">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('todos.destroy', ':id') }}" method="POST" onclick="event.stopPropagation()" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-micro btn-danger" onclick="handleTodoAction(this.closest('form'), 'delete', event);" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                `.replace(/:id/g, todoId);
                            } else {
                                actionsDiv.innerHTML = `
                                    <form action="{{ route('todos.complete', ':id') }}" method="POST" onclick="event.stopPropagation()">
                                        @csrf
                                        <button type="button" class="btn-micro btn-success" title="Mark Complete" onclick="handleTodoAction(this.closest('form'), 'complete', event);">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('todos.edit', ':id') }}" class="btn-micro btn-primary" title="Edit" onclick="event.stopPropagation()">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('todos.destroy', ':id') }}" method="POST" onclick="event.stopPropagation()" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-micro btn-danger" onclick="handleTodoAction(this.closest('form'), 'delete', event);" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                `.replace(/:id/g, todoId);
                            }
                        }
                    }
                } else {
                    const error = await response.json().catch(() => ({}));
                    showMessage(error.message || 'Action failed', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showMessage('Network error. Please try again.', 'error');
            }
        };

        // Toggle Todo Select
        window.toggleTodoSelect = function(todoElement, event) {
            if (['INPUT', 'BUTTON', 'A'].includes(event.target.tagName) || 
                event.target.closest('a') || 
                event.target.closest('button') || 
                event.target.closest('form')) {
                return;
            }
            
            const checkbox = todoElement.querySelector('.form-check-input');
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                
                const count = document.querySelectorAll('.form-check-input:checked').length;
                if (count > 0) {
                    showMessage(`${count} task${count > 1 ? 's' : ''} selected`, 'info', 1500);
                }
                
                todoElement.style.transform = 'scale(0.99)';
                setTimeout(() => {
                    todoElement.style.transform = '';
                }, 150);
            }
        };

        // Toggle All Checkboxes
        window.toggleAllCheckboxes = function(source) {
            const checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(cb => {
                if (cb.id !== 'selectAll') {
                    cb.checked = source.checked;
                }
            });
            
            showMessage(source.checked ? 'All tasks selected' : 'All tasks deselected', 'info', 1500);
        };

        // Bulk Complete
        window.bulkComplete = async function() {
            const checked = Array.from(document.querySelectorAll('.form-check-input:checked'))
                .filter(cb => cb.id !== 'selectAll')
                .map(cb => cb.value);
            
            if (checked.length === 0) {
                showMessage('Please select at least one task', 'warning');
                return;
            }
            
            if (!confirm(`Mark ${checked.length} task${checked.length > 1 ? 's' : ''} as completed?`)) {
                return;
            }
            
            showMessage(`Processing ${checked.length} task${checked.length > 1 ? 's' : ''}...`, 'info');
            
            try {
                const response = await fetch('{{ route("todos.bulk-complete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ ids: checked })
                });
                
                if (response.ok) {
                    showMessage(`${checked.length} task${checked.length > 1 ? 's' : ''} completed successfully!`, 'success');
                    
                    // Update UI instantly
                    checked.forEach(id => {
                        const todoItem = document.querySelector(`.todo-item-micro[data-id="${id}"]`);
                        if (todoItem) {
                            todoItem.classList.add('completed');
                            const title = todoItem.querySelector('.todo-title-micro');
                            if (title) {
                                title.classList.add('text-decoration-line-through', 'opacity-75');
                            }
                        }
                    });
                    
                    // Uncheck all
                    document.querySelectorAll('.form-check-input').forEach(cb => {
                        if (cb.id !== 'selectAll') cb.checked = false;
                    });
                    if (document.getElementById('selectAll')) {
                        document.getElementById('selectAll').checked = false;
                    }
                    
                    updateTodoCount();
                } else {
                    showMessage('Failed to complete tasks', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showMessage('Network error. Please try again.', 'error');
            }
        };

        // Bulk Delete
        window.bulkDelete = async function() {
            const checked = Array.from(document.querySelectorAll('.form-check-input:checked'))
                .filter(cb => cb.id !== 'selectAll')
                .map(cb => cb.value);
            
            if (checked.length === 0) {
                showMessage('Please select at least one task', 'warning');
                return;
            }
            
            if (!confirm(`Permanently delete ${checked.length} task${checked.length > 1 ? 's' : ''}? This cannot be undone.`)) {
                return;
            }
            
            showMessage(`Deleting ${checked.length} task${checked.length > 1 ? 's' : ''}...`, 'warning');
            
            try {
                const response = await fetch('{{ route("todos.bulk-delete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ ids: checked })
                });
                
                if (response.ok) {
                    showMessage(`${checked.length} task${checked.length > 1 ? 's' : ''} deleted successfully!`, 'success');
                    
                    // Remove items instantly
                    checked.forEach(id => {
                        const todoItem = document.querySelector(`.todo-item-micro[data-id="${id}"]`);
                        if (todoItem) {
                            todoItem.style.transition = 'all 0.3s';
                            todoItem.style.opacity = '0';
                            todoItem.style.transform = 'scale(0.8)';
                            setTimeout(() => todoItem.remove(), 300);
                        }
                    });
                    
                    updateTodoCount();
                } else {
                    showMessage('Failed to delete tasks', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showMessage('Network error. Please try again.', 'error');
            }
        };

        // Update Todo Count
        window.updateTodoCount = function() {
            const count = document.querySelectorAll('.todo-item-micro').length;
            const countElement = document.querySelector('.count-number');
            if (countElement) {
                countElement.textContent = count;
            }
        };

        // Real-time Updates
        let realTimeInterval;
        let lastUpdateTime = Date.now();

        window.startRealTimeUpdates = function() {
            if (realTimeInterval) clearInterval(realTimeInterval);

            realTimeInterval = setInterval(async () => {
                try {
                    const response = await fetch(window.location.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        updateStats(data.stats);
                        updateLastUpdate();
                    }
                } catch (error) {
                    console.log('Real-time update failed:', error);
                }
            }, 30000); // Update every 30 seconds
        };

        window.updateStats = function(stats) {
            if (stats) {
                Object.keys(stats).forEach(key => {
                    const element = document.querySelector(`[data-stat="${key}"]`);
                    if (element) {
                        element.textContent = stats[key];
                    }
                });
            }
        };

        window.updateLastUpdate = function() {
            const now = new Date();
            const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const lastUpdateElement = document.getElementById('lastUpdate');
            if (lastUpdateElement) {
                lastUpdateElement.textContent = timeString;
            }

            // Animate the real-time icon
            const icon = document.getElementById('realTimeIcon');
            if (icon) {
                icon.style.animation = 'none';
                setTimeout(() => {
                    icon.style.animation = 'spin 1s ease-in-out';
                }, 10);
            }
        };

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Check URL parameters for filter visibility
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.toString()) {
                setTimeout(() => {
                    if (window.toggleFilters) window.toggleFilters();
                }, 100);
            }

            // Start real-time updates
            startRealTimeUpdates();

            // Handle message from session
            @if(session('success'))
                showMessage('{{ session('success') }}', 'success', 4000);
            @endif
            @if(session('error'))
                showMessage('{{ session('error') }}', 'error', 4000);
            @endif
            @if(session('warning'))
                showMessage('{{ session('warning') }}', 'warning', 4000);
            @endif
        });
    })();
</script>
@endpush