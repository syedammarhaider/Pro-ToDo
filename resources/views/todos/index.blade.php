@extends('layouts.app')

@section('title', 'Dashboard - Professional Todo App')

@section('content')
<div class="message-container" id="messageContainer" aria-live="assertive" aria-atomic="true" aria-relevant="additions"></div>

<!-- Quick Actions Bar -->
@section('quick-actions')
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
    <button class="quick-btn" data-tooltip="Toggle Filters" aria-label="Toggle Filters" onclick="toggleFilters()" style="background: linear-gradient(135deg, var(--accent-purple), var(--accent-pink))">
        <i class="fas fa-filter" id="filterIcon"></i>
    </button>
</div>
@endsection

<div class="dashboard-container">
    <!-- Welcome Header -->
    <header class="dashboard-header">
        <div class="welcome-section">
            <h1 class="welcome-title">
                <span class="welcome-text">Welcome back,</span>
                <span class="user-name">{{ Auth::user()->name }}!</span>
            </h1>
            <p class="welcome-subtitle">Here's your productivity overview for today</p>
        </div>
        
        <div class="header-actions">
            <a href="{{ route('todos.create') }}" class="create-todo-btn">
                <i class="fas fa-plus-circle"></i>
                <span>New Todo</span>
            </a>
        </div>
    </header>

    <!-- Statistics Cards -->
    <section class="statistics-section">
        <button class="statistics-toggle" onclick="toggleStatistics()" aria-expanded="false" aria-controls="statisticsCards">
            <i class="fas fa-chart-line"></i>
            <span>Toggle Statistics</span>
            <i class="fas fa-chevron-down" id="statsArrow"></i>
        </button>
        
        <div class="statistics-grid" id="statisticsCards">
            <!-- Total Todos Card -->
            <div class="stat-card total-todos">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $totalTodos }}</h3>
                    <p class="stat-label">Total Todos</p>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-chart-line"></i>
                    <span>All Tasks</span>
                </div>
            </div>

            <!-- Active Todos Card -->
            <div class="stat-card active-todos">
                <div class="stat-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $activeTodos }}</h3>
                    <p class="stat-label">Active</p>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $totalTodos > 0 ? ($activeTodos/$totalTodos)*100 : 0 }}%"></div>
                    </div>
                    <span class="progress-percentage">{{ $totalTodos > 0 ? round(($activeTodos/$totalTodos)*100) : 0 }}%</span>
                </div>
            </div>

            <!-- Completed Todos Card -->
            <div class="stat-card completed-todos">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $completedTodos }}</h3>
                    <p class="stat-label">Completed</p>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $totalTodos > 0 ? ($completedTodos/$totalTodos)*100 : 0 }}%"></div>
                    </div>
                    <span class="progress-percentage">{{ $totalTodos > 0 ? round(($completedTodos/$totalTodos)*100) : 0 }}%</span>
                </div>
            </div>

            <!-- Overdue Todos Card -->
            <div class="stat-card overdue-todos">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $overdueTodos }}</h3>
                    <p class="stat-label">Overdue</p>
                </div>
                @if($overdueTodos > 0)
                <div class="stat-alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Needs Attention</span>
                </div>
                @endif
            </div>

            <!-- Priority Distribution -->
            <div class="stat-card priority-distribution">
                <div class="stat-icon">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $highPriorityTodos }}</h3>
                    <p class="stat-label">High Priority</p>
                </div>
                <div class="priority-breakdown">
                    <div class="priority-item">
                        <span class="priority-dot high"></span>
                        <span>High: {{ $highPriorityTodos }}</span>
                    </div>
                    <div class="priority-item">
                        <span class="priority-dot medium"></span>
                        <span>Medium: {{ $mediumPriorityTodos }}</span>
                    </div>
                    <div class="priority-item">
                        <span class="priority-dot low"></span>
                        <span>Low: {{ $lowPriorityTodos }}</span>
                    </div>
                </div>
            </div>

            <!-- Productivity Score -->
            <div class="stat-card productivity-score">
                <div class="stat-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="stat-content">
                    @php
                        $productivityScore = $totalTodos > 0 ? round(($completedTodos/$totalTodos)*100) : 0;
                    @endphp
                    <h3 class="stat-number">{{ $productivityScore }}<span class="percent">%</span></h3>
                    <p class="stat-label">Productivity Score</p>
                </div>
                <div class="productivity-gauge">
                    <div class="gauge">
                        <div class="gauge-fill" style="transform: rotate({{ ($productivityScore/100)*180 }}deg)"></div>
                    </div>
                    <span class="gauge-label">{{ $productivityScore >= 80 ? 'Excellent' : ($productivityScore >= 60 ? 'Good' : 'Needs Improvement') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters-section">
        <div class="card glass-effect filters-card" id="filtersCard">
            <div class="card-body">
                <button class="filter-toggle-btn" aria-expanded="false" aria-controls="filterContent" onclick="toggleFilters()">
                    <i class="fas fa-sliders-h"></i>
                    <span>Filters & Search</span>
                    <i class="fas fa-chevron-down" id="filterArrow"></i>
                </button>
                
                <div id="filterContent" style="display:none;">
                    <form action="{{ route('todos.index') }}" method="GET" class="filter-form" role="search" aria-label="Todo search and filters">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label for="search" class="filter-label">
                                    <i class="fas fa-search"></i> Search
                                </label>
                                <input type="search" 
                                       name="search" 
                                       class="filter-input" 
                                       placeholder="Search todos..." 
                                       value="{{ request('search') }}"
                                       aria-label="Search todos">
                            </div>

                            <div class="filter-group">
                                <label for="status" class="filter-label">
                                    <i class="fas fa-chart-bar"></i> Status
                                </label>
                                <select name="status" class="filter-select" aria-label="Filter by status">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="priority" class="filter-label">
                                    <i class="fas fa-flag"></i> Priority
                                </label>
                                <select name="priority" class="filter-select" aria-label="Filter by priority">
                                    <option value="">All Priorities</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="category" class="filter-label">
                                    <i class="fas fa-tag"></i> Category
                                </label>
                                <select name="category" class="filter-select" aria-label="Filter by category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="sort" class="filter-label">
                                    <i class="fas fa-sort"></i> Sort By
                                </label>
                                <select name="sort" class="filter-select" aria-label="Sort by">
                                    <option value="">Default</option>
                                    <option value="due_date" {{ request('sort') == 'due_date' ? 'selected' : '' }}>Due Date</option>
                                    <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Priority</option>
                                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="direction" class="filter-label">
                                    <i class="fas fa-sort-amount-down"></i> Order
                                </label>
                                <select name="direction" class="filter-select" aria-label="Sort direction">
                                    <option value="desc">Descending</option>
                                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                </select>
                            </div>

                            <div class="filter-actions">
                                <button type="submit" class="filter-apply-btn">
                                    <i class="fas fa-filter"></i>
                                    <span>Apply Filters</span>
                                </button>
                                
                                <a href="{{ route('todos.index') }}" class="filter-reset-btn">
                                    <i class="fas fa-rotate-left"></i>
                                    <span>Reset</span>
                                </a>
                            </div>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="bulk-actions">
                            <div class="bulk-select">
                                <input type="checkbox" 
                                       id="selectAll" 
                                       class="bulk-checkbox"
                                       onchange="toggleAllCheckboxes(this)"
                                       aria-label="Select or deselect all todos">
                                <label for="selectAll" class="bulk-label">Select All</label>
                            </div>
                            
                            <div class="bulk-buttons">
                                <button type="button" class="bulk-btn bulk-complete" onclick="bulkComplete()" aria-label="Mark selected todos complete">
                                    <i class="fas fa-check-double"></i>
                                    <span>Complete</span>
                                </button>
                                
                                <button type="button" class="bulk-btn bulk-delete" onclick="bulkDelete()" aria-label="Delete selected todos">
                                    <i class="fas fa-trash-can"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Todos Grid -->
    <section class="todos-section" aria-live="polite" aria-relevant="additions removals" aria-label="List of todos">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-list-check"></i>
                Your Todos
                <span class="todos-count">({{ $todos->total() }})</span>
            </h2>
            
            <div class="view-toggle">
                <button class="view-btn active" onclick="changeView('grid')" aria-label="Grid view">
                    <i class="fas fa-grid"></i>
                </button>
                <button class="view-btn" onclick="changeView('list')" aria-label="List view">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        @if($todos->count() > 0)
            <div class="todos-grid" id="todosGrid">
                @foreach($todos as $todo)
                    <article class="todo-card {{ $todo->priority }} {{ $todo->completed ? 'completed' : '' }}" 
                             data-id="{{ $todo->id }}"
                             role="listitem"
                             tabindex="0"
                             aria-label="Todo: {{ $todo->title }}, Priority: {{ ucfirst($todo->priority) }}, Status: {{ $todo->completed ? 'Completed' : 'Active' }}"
                             onclick="toggleTodoSelect(this, event)">
                        
                        <div class="todo-card-header">
                            <input type="checkbox" 
                                   class="todo-checkbox"
                                   name="todo_ids[]"
                                   value="{{ $todo->id }}"
                                   aria-label="Select todo {{ $todo->title }}"
                                   onclick="event.stopPropagation()">
                            
                            <div class="todo-title-container">
                                <h3 class="todo-title {{ $todo->completed ? 'completed' : '' }}">
                                    @if(request('search'))
                                        @php
                                            $searchTerm = request('search');
                                            $highlightedTitle = preg_replace('/(' . preg_quote($searchTerm, '/') . ')/i', '<mark class="search-highlight">$1</mark>', $todo->title);
                                        @endphp
                                        {!! $highlightedTitle !!}
                                    @else
                                        {{ $todo->title }}
                                    @endif
                                </h3>
                                
                                @if($todo->description)
                                    <p class="todo-description">{{ Str::limit($todo->description, 100) }}</p>
                                @endif
                            </div>
                            
                            <div class="todo-actions">
                                @if(!$todo->completed)
                                    <form action="{{ route('todos.complete', $todo) }}" method="POST" onclick="event.stopPropagation()">
                                        @csrf
                                        <button type="button" 
                                                class="todo-action-btn complete-btn"
                                                title="Mark Complete"
                                                aria-pressed="false"
                                                onclick="handleTodoAction(this.closest('form'), 'complete', event);">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('todos.incomplete', $todo) }}" method="POST" onclick="event.stopPropagation()">
                                        @csrf
                                        <button type="button" 
                                                class="todo-action-btn incomplete-btn"
                                                title="Mark Incomplete"
                                                aria-pressed="true"
                                                onclick="handleTodoAction(this.closest('form'), 'incomplete', event);">
                                            <i class="fas fa-rotate-left"></i>
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('todos.edit', $todo) }}" 
                                   class="todo-action-btn edit-btn"
                                   title="Edit"
                                   onclick="event.stopPropagation()">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('todos.destroy', $todo) }}" 
                                      method="POST" 
                                      onclick="event.stopPropagation()" 
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="todo-action-btn delete-btn"
                                            onclick="handleTodoAction(this.closest('form'), 'delete', event);" 
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="todo-card-body">
                            <div class="todo-meta">
                                <span class="priority-badge priority-{{ $todo->priority }}">
                                    <i class="fas fa-flag"></i>
                                    {{ ucfirst($todo->priority) }} Priority
                                </span>
                                
                                @if($todo->category)
                                    <span class="category-badge">
                                        <i class="fas fa-tag"></i>
                                        {{ $todo->category }}
                                    </span>
                                @endif
                                
                                @if($todo->due_date)
                                    <span class="due-date-badge {{ $todo->isOverdue() && !$todo->completed ? 'overdue' : '' }}">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $todo->due_date->format('M d, Y') }}
                                        @if($todo->isOverdue() && !$todo->completed)
                                            <span class="overdue-indicator">Overdue</span>
                                        @endif
                                    </span>
                                @endif
                            </div>
                            
                            <div class="todo-footer">
                                <span class="created-date">
                                    <i class="fas fa-clock"></i>
                                    Created {{ $todo->created_at->diffForHumans() }}
                                </span>
                                
                                <a href="{{ route('todos.show', $todo) }}" 
                                   class="view-details-btn"
                                   onclick="event.stopPropagation()">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </a>
                            </div>
                        </div>
                        
                        <!-- Progress Indicator for Incomplete Todos -->
                        @if(!$todo->completed && $todo->due_date)
                            @php
                                $dueInDays = now()->diffInDays($todo->due_date, false);
                                $progressPercent = $dueInDays <= 0 ? 100 : max(0, min(100, (7 - $dueInDays) * (100/7)));
                            @endphp
                            <div class="todo-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $progressPercent }}%"></div>
                                </div>
                                <span class="progress-text">
                                    @if($dueInDays < 0)
                                        Overdue by {{ abs($dueInDays) }} days
                                    @elseif($dueInDays == 0)
                                        Due today
                                    @else
                                        Due in {{ $dueInDays }} days
                                    @endif
                                </span>
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($todos->hasPages())
                <div class="pagination-container">
                    <nav aria-label="Pagination navigation">
                        <div class="pagination-content">
                            @if($todos->onFirstPage())
                                <span class="pagination-link disabled" aria-hidden="true">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $todos->previousPageUrl() }}" class="pagination-link" aria-label="Previous page">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif
                            
                            <div class="pagination-numbers">
                                @php
                                    $current = $todos->currentPage();
                                    $last = $todos->lastPage();
                                    $start = max(1, $current - 2);
                                    $end = min($last, $current + 2);
                                    
                                    if ($start > 1) {
                                        echo '<a href="' . $todos->url(1) . '" class="pagination-number">1</a>';
                                        if ($start > 2) echo '<span class="pagination-ellipsis">...</span>';
                                    }
                                    
                                    for ($i = $start; $i <= $end; $i++) {
                                        if ($i == $current) {
                                            echo '<span class="pagination-number active" aria-current="page">' . $i . '</span>';
                                        } else {
                                            echo '<a href="' . $todos->url($i) . '" class="pagination-number">' . $i . '</a>';
                                        }
                                    }
                                    
                                    if ($end < $last) {
                                        if ($end < $last - 1) echo '<span class="pagination-ellipsis">...</span>';
                                        echo '<a href="' . $todos->url($last) . '" class="pagination-number">' . $last . '</a>';
                                    }
                                @endphp
                            </div>
                            
                            @if($todos->hasMorePages())
                                <a href="{{ $todos->nextPageUrl() }}" class="pagination-link" aria-label="Next page">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="pagination-link disabled" aria-hidden="true">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                        
                        <div class="pagination-info">
                            <span class="page-info">
                                Page {{ $todos->currentPage() }} of {{ $todos->lastPage() }}
                            </span>
                            <span class="total-info">
                                {{ $todos->total() }} total todos
                            </span>
                        </div>
                    </nav>
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="empty-title">No todos found</h3>
                <p class="empty-message">
                    @if(request()->hasAny(['search', 'status', 'priority', 'category']))
                        Try adjusting your filters or search terms
                    @else
                        Start organizing your tasks and boost productivity!
                    @endif
                </p>
                <div class="empty-actions">
                    <a href="{{ route('todos.create') }}" class="empty-action-btn primary">
                        <i class="fas fa-plus-circle"></i>
                        Create Your First Todo
                    </a>
                    @if(request()->hasAny(['search', 'status', 'priority', 'category']))
                        <a href="{{ route('todos.index') }}" class="empty-action-btn secondary">
                            <i class="fas fa-rotate-left"></i>
                            Clear Filters
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </section>
</div>
@endsection

@section('scripts')
<script>
(() => {
    // State variables
    let filtersVisible = false;
    let statsVisible = true;
    let currentView = 'grid';
    
    // DOM Elements
    const messageContainer = document.getElementById('messageContainer');
    const filterContent = document.getElementById('filterContent');
    const filterArrow = document.getElementById('filterArrow');
    const filtersCard = document.getElementById('filtersCard');
    const filterIcon = document.getElementById('filterIcon');
    const statisticsCards = document.getElementById('statisticsCards');
    const statsArrow = document.getElementById('statsArrow');
    const todosGrid = document.getElementById('todosGrid');

    // Toggle Functions
    function toggleFilters() {
        filtersVisible = !filtersVisible;
        filterContent.style.display = filtersVisible ? 'block' : 'none';
        filterArrow.className = filtersVisible ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
        filtersCard.classList.toggle('expanded', filtersVisible);
        filterIcon.className = filtersVisible ? 'fas fa-times' : 'fas fa-filter';
        showMessage(`Filters ${filtersVisible ? 'expanded' : 'collapsed'}`, 'info');
    }

    function toggleStatistics() {
        statsVisible = !statsVisible;
        statisticsCards.style.display = statsVisible ? 'grid' : 'none';
        statsArrow.className = statsVisible ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
        showMessage(`Statistics ${statsVisible ? 'shown' : 'hidden'}`, 'info');
    }

    function changeView(view) {
        if (view === currentView) return;
        
        currentView = view;
        document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        todosGrid.className = view === 'grid' ? 'todos-grid' : 'todos-list';
        showMessage(`Switched to ${view} view`, 'info');
    }

    // Message System
    function showMessage(text, type = 'info', duration = 3000) {
        if (!messageContainer) return;
        
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        
        const messageId = 'msg-' + Date.now();
        const message = document.createElement('div');
        message.className = `message ${type}`;
        message.id = messageId;
        message.innerHTML = `
            <div class="message-content">
                <div class="message-icon"><i class="${icons[type]}"></i></div>
                <div class="message-text">
                    <h5>${type.charAt(0).toUpperCase() + type.slice(1)}</h5>
                    <p>${text}</p>
                </div>
            </div>
            <button class="message-close" aria-label="Close message" onclick="removeMessage('${messageId}')">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        messageContainer.appendChild(message);
        setTimeout(() => message.classList.add('show'), 10);
        
        if (duration > 0) {
            setTimeout(() => removeMessage(messageId), duration);
        }
    }

    function removeMessage(id) {
        const message = document.getElementById(id);
        if (!message) return;
        
        message.classList.remove('show');
        setTimeout(() => message.remove(), 300);
    }

    // Todo Actions
    async function handleTodoAction(form, action, event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        const formData = new FormData(form);
        const todoItem = form.closest('.todo-card');
        const todoId = todoItem.dataset.id;
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            if (response.ok) {
                const result = await response.json();
                showMessage(result.message, 'success');
                
                if (action === 'delete') {
                    // Animate removal
                    todoItem.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                    todoItem.style.opacity = '0';
                    todoItem.style.transform = 'scale(0.8) translateY(20px)';
                    
                    setTimeout(() => {
                        todoItem.remove();
                        
                        // Check if empty
                        if (document.querySelectorAll('.todo-card').length === 0) {
                            location.reload(); // Reload to update statistics
                        }
                    }, 300);
                } else {
                    // Update todo status
                    updateTodoStatus(todoItem, action === 'complete');
                }
            } else {
                const errorData = await response.json().catch(() => ({}));
                showMessage(errorData.message || 'Failed to update todo', 'error');
            }
        } catch {
            showMessage('Network error. Please try again.', 'error');
        }
    }

    function updateTodoStatus(todoItem, isCompleted) {
        todoItem.classList.toggle('completed', isCompleted);
        
        const title = todoItem.querySelector('.todo-title');
        const completeBtn = todoItem.querySelector('.complete-btn');
        const incompleteBtn = todoItem.querySelector('.incomplete-btn');
        
        if (isCompleted) {
            title.classList.add('completed');
            if (completeBtn) completeBtn.style.display = 'none';
            if (incompleteBtn) incompleteBtn.style.display = 'flex';
        } else {
            title.classList.remove('completed');
            if (completeBtn) completeBtn.style.display = 'flex';
            if (incompleteBtn) incompleteBtn.style.display = 'none';
        }
    }

    // Selection Functions
    function toggleTodoSelect(todoElement, event) {
        if (['INPUT', 'BUTTON', 'A', 'FORM'].includes(event.target.tagName) || 
            event.target.closest('button') || 
            event.target.closest('a') || 
            event.target.closest('form')) {
            return;
        }
        
        const checkbox = todoElement.querySelector('.todo-checkbox');
        checkbox.checked = !checkbox.checked;
        
        const count = document.querySelectorAll('.todo-checkbox:checked').length;
        if (count > 0) {
            showMessage(`${count} todo${count > 1 ? 's' : ''} selected`, 'info', 1500);
        }
        
        // Visual feedback
        todoElement.style.transform = 'scale(0.98)';
        setTimeout(() => {
            todoElement.style.transform = '';
        }, 150);
    }

    function toggleAllCheckboxes(source) {
        const checkboxes = document.querySelectorAll('.todo-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = source.checked;
            cb.dispatchEvent(new Event('change'));
        });
        
        const count = source.checked ? checkboxes.length : 0;
        showMessage(`${source.checked ? 'All' : 'No'} todos selected`, 'info', 1500);
    }

    // Bulk Actions
    async function bulkComplete() {
        const checked = document.querySelectorAll('.todo-checkbox:checked');
        if (!checked.length) {
            showMessage('Please select at least one todo', 'warning');
            return;
        }
        
        const ids = Array.from(checked).map(cb => cb.value);
        if (!confirm(`Mark ${ids.length} todo${ids.length > 1 ? 's' : ''} as completed?`)) return;
        
        showMessage(`Completing ${ids.length} todo${ids.length > 1 ? 's' : ''}...`, 'info');
        
        try {
            const response = await fetch('{{ route("todos.bulk-complete") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids })
            });
            
            if (response.ok) {
                showMessage(`${ids.length} todo${ids.length > 1 ? 's' : ''} marked as completed!`, 'success');
                
                // Update UI
                checked.forEach(cb => {
                    const todoItem = cb.closest('.todo-card');
                    updateTodoStatus(todoItem, true);
                    cb.checked = false;
                });
                
                document.getElementById('selectAll').checked = false;
                
                // Reload statistics
                setTimeout(() => location.reload(), 1000);
            } else {
                showMessage('Failed to complete todos', 'error');
            }
        } catch {
            showMessage('Network error. Please try again.', 'error');
        }
    }

    async function bulkDelete() {
        const checked = document.querySelectorAll('.todo-checkbox:checked');
        if (!checked.length) {
            showMessage('Please select at least one todo', 'warning');
            return;
        }
        
        const ids = Array.from(checked).map(cb => cb.value);
        if (!confirm(`Delete ${ids.length} todo${ids.length > 1 ? 's' : ''} permanently? This action cannot be undone.`)) return;
        
        showMessage(`Deleting ${ids.length} todo${ids.length > 1 ? 's' : ''}...`, 'warning');
        
        try {
            const response = await fetch('{{ route("todos.bulk-delete") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids })
            });
            
            if (response.ok) {
                showMessage(`${ids.length} todo${ids.length > 1 ? 's' : ''} deleted successfully!`, 'success');
                
                // Animate removal
                checked.forEach(cb => {
                    const todoItem = cb.closest('.todo-card');
                    todoItem.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                    todoItem.style.opacity = '0';
                    todoItem.style.transform = 'scale(0.8) translateY(20px)';
                    
                    setTimeout(() => todoItem.remove(), 300);
                });
                
                document.getElementById('selectAll').checked = false;
                
                // Reload if no todos left
                setTimeout(() => {
                    if (document.querySelectorAll('.todo-card').length === 0) {
                        location.reload();
                    }
                }, 500);
            } else {
                showMessage('Failed to delete todos', 'error');
            }
        } catch {
            showMessage('Network error. Please try again.', 'error');
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        // Show URL messages
        const params = new URLSearchParams(window.location.search);
        if (params.has('message')) {
            const msg = decodeURIComponent(params.get('message'));
            const type = params.get('type') || 'success';
            showMessage(msg, type, 5000);
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + N for new todo
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                window.location.href = '{{ route("todos.create") }}';
            }
            
            // Escape to close filters
            if (e.key === 'Escape' && filtersVisible) {
                toggleFilters();
            }
            
            // Ctrl/Cmd + F to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                document.querySelector('.search-input')?.focus();
            }
        });
        
        // Auto-close dropdowns on scroll
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.dropdown-menu.show').forEach(item => {
                item.classList.remove('show');
            });
        });
    });

    // Export functions to global scope
    window.toggleFilters = toggleFilters;
    window.toggleStatistics = toggleStatistics;
    window.changeView = changeView;
    window.showMessage = showMessage;
    window.removeMessage = removeMessage;
    window.handleTodoAction = handleTodoAction;
    window.updateTodoStatus = updateTodoStatus;
    window.toggleTodoSelect = toggleTodoSelect;
    window.toggleAllCheckboxes = toggleAllCheckboxes;
    window.bulkComplete = bulkComplete;
    window.bulkDelete = bulkDelete;
})();
</script>
@endsection