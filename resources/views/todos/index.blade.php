@extends('layouts.app')

@section('title', 'All Todos - Professional Todo App')

@section('content')
<div class="message-container" id="messageContainer" aria-live="assertive" aria-atomic="true" aria-relevant="additions"></div>

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

<div class="container-fluid px-2 px-md-3">
    <header class="page-header compact" id="pageHeader" role="banner">
        <div class="d-flex justify-content-between align-items-center" >
            <div class="d-flex align-items-center gap-4">
                <div class="welcome-section">
                    <h1 tabindex="0" class="welcome-text">
                         Welc, <span class="user-name">{{ Auth::user()->name }}</span>!
                    </h1>
                </div>
                <div class="todos-count-badge">
                    <div class="count-content">
                        <div class="count-number">{{ $todos->total() }}</div>
                        <div class="count-label">Todos</div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('profile.edit') }}" class="action-btn profile-btn" role="button" aria-label="Edit profile">
                    <i class="fas fa-user"></i>
                    <span class="btn-text">Prile</span>
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
                    <span class="btn-text">New Todo</span>
                </a>
            </div>
        </div>
    </header>

    <section>
        <div class="card glass-effect filters-card" id="filtersCard">
            <div class="card-body p-3">
                <button class="filter-toggle-btn mb-3 w-100" aria-expanded="false" aria-controls="filterContent" onclick="toggleFilters()">
                    <i class="fas fa-sliders-h"></i>
                    <span>Filters & Search</span>
                    <i class="fas fa-chevron-down ms-auto" id="filterArrow"></i>
                </button>
                <div id="filterContent" style="display:none;">
                    <form action="{{ route('todos.index') }}" method="GET" class="row g-2" role="search" aria-label="Todo search and filters">
                        <div class="col-12 col-md-6 col-lg-2">
                            <input type="search" name="search" class="form-control-micro" placeholder="🔍 Search todos..." value="{{ request('search') }}" aria-label="Search todos">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="status" class="form-select-micro" aria-label="Filter by status">
                                <option value="">📊 Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>▶ Active</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>⏰ Overdue</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="priority" class="form-select-micro" aria-label="Filter by priority">
                                <option value="">🎯 Priority</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="sort" class="form-select-micro" aria-label="Sort by">
                                <option value="">📅 Sort by</option>
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
                        <div class="col-12 col-md-6 col-lg-2">
                            <select name="category" class="form-select-micro" aria-label="Filter by category">
                                <option value="">🏷️ Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm w-100" style="min-height:42px;" aria-label="Apply filters">
                                    <i class="fas fa-filter"></i>
                                    <span class="d-none d-md-inline">Filter</span>
                                </button>
                                <a href="{{ route('todos.index') }}" class="btn btn-secondary btn-sm w-100" style="min-height:42px;" aria-label="Reset filters">
                                    <i class="fas fa-rotate-right"></i>
                                    <span class="d-none d-md-inline">Reset</span>
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2" aria-label="Bulk actions">
                        <div class="form-check">
                            <input class="form-check-input todo-checkbox-micro" type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)" aria-label="Select or deselect all todos">
                            <label class="form-check-label" for="selectAll" style="font-size:0.875rem; color: var(--text-primary); font-weight: 500;">
                                Select All
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

    <section aria-live="polite" aria-relevant="additions removals" aria-label="List of todos">
        <div class="card glass-effect">
            <div class="card-body p-2 p-md-3">
                @if($todos->count() > 0)
                    <div class="todo-grid" id="todoGrid" role="list">
                        @foreach($todos as $todo)
                            <article class="todo-item-micro {{ $todo->priority }} {{ $todo->completed ? 'completed' : '' }}" 
                                     data-id="{{ $todo->id }}" role="listitem" tabindex="0" aria-label="Todo: {{ $todo->title }}, Priority: {{ ucfirst($todo->priority) }}, Status: {{ $todo->completed ? 'Completed' : 'Active' }}" onclick="toggleTodoSelect(this, event)">
                                <div class="todo-header-micro">
                                    <input class="form-check-input todo-checkbox-micro" 
                                           type="checkbox" 
                                           name="todo_ids[]" 
                                           value="{{ $todo->id }}" 
                                           aria-label="Select todo {{ $todo->title }}" 
                                           onclick="event.stopPropagation()">
                                    <h6 class="todo-title-micro text-truncate-2 {{ $todo->completed ? 'strikethrough' : '' }}" style="{{ $todo->completed ? 'opacity: 0.6; color: rgba(255,255,255,0.7);' : '' }}">
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
                                    <div class="todo-actions-micro">
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
                                        <span class="priority-badge-micro bg-{{ $todo->getPriorityColor() }}">
                                            <i class="fas fa-flag"></i> {{ ucfirst($todo->priority) }}
                                        </span>
                                        @if($todo->category)
                                            <span class="category-tag-micro">
                                                <i class="fas fa-tag"></i> {{ $todo->category }}
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('todos.show', $todo) }}" class="text-decoration-none" onclick="event.stopPropagation()">
                                        <small style="color: white !important;"><i class="fas fa-eye"></i> View</small>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state-micro fade-in" role="alert" aria-live="polite" aria-atomic="true">
                        <div class="empty-icon-micro" aria-hidden="true"><i class="fas fa-clipboard-list"></i></div>
                        <h5>No todos found</h5>
                        <p>Start organizing your tasks and boost productivity!</p>
                        <a href="{{ route('todos.create') }}" class="btn-primary-micro" role="button" aria-label="Create your first todo">
                            <i class="fas fa-plus-circle"></i> Create First Todo
                        </a>
                    </div>
                @endif
            </div>
            @if($todos->hasPages())
                <div class="card-footer bg-transparent border-top border-white border-opacity-10 py-3">
                    <nav aria-label="Pagination navigation">
                        <div class="pagination-container">
                            @if($todos->onFirstPage())
                                <span class="pagination-link disabled">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $todos->previousPageUrl() }}" class="pagination-link">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif
                            
                            <div class="pagination-nav">
                                @php
                                    $onEachSide = 2;
                                @endphp
                                
                                @if($todos->currentPage() > $onEachSide + 1)
                                    <a href="{{ $todos->url(1) }}" class="pagination-link">1</a>
                                    
                                    @if($todos->currentPage() > $onEachSide + 2)
                                        <span class="pagination-ellipsis">...</span>
                                    @endif
                                @endif
                                
                                @php
                                    $start = max(1, $todos->currentPage() - $onEachSide);
                                    $end = min($todos->lastPage(), $todos->currentPage() + $onEachSide);
                                @endphp
                                
                                @for($i = $start; $i <= $end; $i++)
                                    @if($i == $todos->currentPage())
                                        <span class="pagination-link active">{{ $i }}</span>
                                    @else
                                        <a href="{{ $todos->url($i) }}" class="pagination-link">{{ $i }}</a>
                                    @endif
                                @endfor
                                
                                @if($todos->currentPage() < $todos->lastPage() - $onEachSide)
                                    @if($todos->currentPage() < $todos->lastPage() - $onEachSide - 1)
                                        <span class="pagination-ellipsis">...</span>
                                    @endif
                                    
                                    <a href="{{ $todos->url($todos->lastPage()) }}" class="pagination-link">{{ $todos->lastPage() }}</a>
                                @endif
                            </div>
                            
                            @if($todos->hasMorePages())
                                <a href="{{ $todos->nextPageUrl() }}" class="pagination-link">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="pagination-link disabled">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </nav>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
(() => {
  let filtersVisible = false;
  const messageContainer = document.getElementById('messageContainer');
  const filterContent = document.getElementById('filterContent');
  const filterArrow = document.getElementById('filterArrow');
  const filtersCard = document.getElementById('filtersCard');
  const filterIcon = document.getElementById('filterIcon');

  function toggleFilters() {
    filtersVisible = !filtersVisible;
    filterContent.style.display = filtersVisible ? 'block' : 'none';
    filterArrow.className = filtersVisible ? 'fas fa-chevron-up ms-auto' : 'fas fa-chevron-down ms-auto';
    filtersCard.classList.toggle('filters-collapsed', !filtersVisible);
    filterIcon.className = filtersVisible ? 'fas fa-times' : 'fas fa-filter';
    showMessage(`Filters ${filtersVisible ? 'expanded' : 'collapsed'}`, 'info');
  }

  function showMessage(text, type='info', duration=2000) {
    if (!messageContainer) return;
    const icons = {
      success:'fas fa-check-circle',
      error:'fas fa-exclamation-circle',
      warning:'fas fa-exclamation-triangle',
      info:'fas fa-info-circle'
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
      </button>`;
    messageContainer.appendChild(message);
    setTimeout(() => message.classList.add('show'), 10);
    if (duration > 0) setTimeout(() => removeMessage(messageId), duration);
  }

  function removeMessage(id) {
    const message = document.getElementById(id);
    if (!message) return;
    message.classList.remove('show');
    setTimeout(() => message.remove(), 500);
  }

  async function handleTodoAction(form, action, event) {
    if(event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const formData = new FormData(form);
    const todoItem = form.closest('.todo-item-micro');
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
          todoItem.style.transition = 'all 0.3s ease-out';
          todoItem.style.opacity = '0';
          todoItem.style.transform = 'scale(0.8)';
          setTimeout(() => {
            todoItem.remove();
            if(document.querySelectorAll('.todo-item-micro').length === 0) {
              const todoGrid = document.getElementById('todoGrid');
              todoGrid.innerHTML = `
                <div class="empty-state-micro fade-in" role="alert" aria-live="polite" aria-atomic="true">
                  <div class="empty-icon-micro" aria-hidden="true"><i class="fas fa-clipboard-list"></i></div>
                  <h5>No todos found</h5>
                  <p>Start organizing your tasks and boost productivity!</p>
                  <a href="{{ route('todos.create') }}" class="btn-primary-micro" role="button" aria-label="Create your first todo">
                    <i class="fas fa-plus-circle"></i> Create First Todo
                  </a>
                </div>`;
            }
          }, 300);
        } else {
          updateTodoActions(todoItem, todoId, action === 'complete');
        }
      } else {
        const errorData = await response.json().catch(() => ({}));
        showMessage(errorData.message || 'Failed to update todo', 'error');
      }
    } catch {
      showMessage('Network error. Please try again.', 'error');
    }
  }

  function updateTodoActions(todoItem, todoId, isCompleted) {
    const actionsDiv = todoItem.querySelector('.todo-actions-micro');
    if (isCompleted) {
      todoItem.classList.add('completed');
      const title = todoItem.querySelector('.todo-title-micro');
      title.style.textDecoration = 'line-through';
      title.style.opacity = '0.6';
      title.style.color = 'rgba(255,255,255,0.7)';
      actionsDiv.innerHTML = `
        <form action="{{ route('todos.incomplete', ':todo') }}" method="POST" onclick="event.stopPropagation()">
          @csrf
          <button type="submit" class="btn-micro btn-warning" title="Mark Incomplete" aria-pressed="true" onclick="handleTodoAction(this.closest('form'), 'incomplete', event); return false;">
            <i class="fas fa-rotate-left"></i>
          </button>
        </form>
        <a href="{{ route('todos.edit', ':todo') }}" class="btn-micro btn-primary" title="Edit" onclick="event.stopPropagation()">
          <i class="fas fa-edit"></i>
        </a>
        <form action="{{ route('todos.destroy', ':todo') }}" method="POST" onclick="event.stopPropagation()" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-micro btn-danger" onclick="handleTodoAction(this.closest('form'), 'delete'); return false;" title="Delete">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      `.replace(/:todo/g, todoId);
    } else {
      todoItem.classList.remove('completed');
      const title = todoItem.querySelector('.todo-title-micro');
      title.style.textDecoration = 'none';
      title.style.opacity = '1';
      title.style.color = 'white';
      actionsDiv.innerHTML = `
        <form action="{{ route('todos.complete', ':todo') }}" method="POST" onclick="event.stopPropagation()">
          @csrf
          <button type="submit" class="btn-micro btn-success" title="Mark Complete" aria-pressed="false" onclick="handleTodoAction(this.closest('form'), 'complete', event); return false;">
            <i class="fas fa-check"></i>
          </button>
        </form>
        <a href="{{ route('todos.edit', ':todo') }}" class="btn-micro btn-primary" title="Edit" onclick="event.stopPropagation()">
          <i class="fas fa-edit"></i>
        </a>
        <form action="{{ route('todos.destroy', ':todo') }}" method="POST" onclick="event.stopPropagation()" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-micro btn-danger" onclick="handleTodoAction(this.closest('form'), 'delete'); return false;" title="Delete">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      `.replace(/:todo/g, todoId);
    }
  }

  function toggleTodoSelect(todoElement, event) {
    if(['INPUT','BUTTON','A'].includes(event.target.tagName) || event.target.closest('a') || event.target.closest('button') || event.target.closest('form')) return;
    const checkbox = todoElement.querySelector('.todo-checkbox-micro');
    checkbox.checked = !checkbox.checked;
    const count = document.querySelectorAll('.todo-checkbox-micro:checked').length;
    if (count > 0) showMessage(`${count} todo${count>1?'s':''} selected`, 'info', 2000);
    todoElement.style.transform = 'scale(0.98)';
    setTimeout(() => { todoElement.style.transform = ''; }, 150);
  }

  function toggleAllCheckboxes(source) {
    const checkboxes = document.querySelectorAll('.todo-checkbox-micro');
    checkboxes.forEach(cb => cb.checked = source.checked);
    showMessage(`${source.checked ? 'All' : 'No'} todos selected`, 'info', 2000);
  }

  async function bulkComplete() {
    const checked = document.querySelectorAll('.todo-checkbox-micro:checked');
    if (!checked.length) { showMessage('Please select at least one todo', 'warning'); return; }
    const ids = Array.from(checked).map(cb => cb.value);
    if (!confirm(`Mark ${ids.length} todo${ids.length>1?'s':''} as completed?`)) return;
    showMessage(`Completing ${ids.length} todo${ids.length>1?'s':''}...`, 'info');
    try {
      const res = await fetch('{{ route("todos.bulk-complete") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ ids })
      });
      if (res.ok) {
        showMessage(`${ids.length} todo${ids.length>1?'s':''} marked as completed!`, 'success');
        // Update DOM instantly instead of reloading
        checked.forEach(cb => {
          const todoItem = cb.closest('.todo-item-micro');
          todoItem.classList.add('completed');
          const title = todoItem.querySelector('.todo-title-micro');
          title.style.textDecoration = 'line-through';
          title.style.opacity = '0.6';
          title.style.color = 'rgba(255,255,255,0.7)';
          cb.checked = false;
        });
        document.getElementById('selectAll').checked = false;
      } else showMessage('Failed to complete todos', 'error');
    } catch {
      showMessage('Network error. Please try again.', 'error');
    }
  }

  async function bulkDelete() {
    const checked = document.querySelectorAll('.todo-checkbox-micro:checked');
    if (!checked.length) { showMessage('Please select at least one todo', 'warning'); return; }
    const ids = Array.from(checked).map(cb => cb.value);
    if (!confirm(`Delete ${ids.length} todo${ids.length>1?'s':''} permanently? This cannot be undone.`)) return;
    showMessage(`Deleting ${ids.length} todo${ids.length>1?'s':''}...`, 'warning');
    try {
      const res = await fetch('{{ route("todos.bulk-delete") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ ids })
      });
      if (res.ok) {
        showMessage(`${ids.length} todo${ids.length>1?'s':''} deleted successfully!`, 'success');
        // Remove items instantly instead of reloading
        checked.forEach(cb => {
          const todoItem = cb.closest('.todo-item-micro');
          todoItem.style.transition = 'all 0.3s ease-out';
          todoItem.style.opacity = '0';
          todoItem.style.transform = 'scale(0.8)';
          setTimeout(() => {
            todoItem.remove();
            if(document.querySelectorAll('.todo-item-micro').length === 0) {
              const todoGrid = document.getElementById('todoGrid');
              todoGrid.innerHTML = `
                <div class="empty-state-micro fade-in" role="alert" aria-live="polite" aria-atomic="true">
                  <div class="empty-icon-micro" aria-hidden="true"><i class="fas fa-clipboard-list"></i></div>
                  <h5>No todos found</h5>
                  <p>Start organizing your tasks and boost productivity!</p>
                  <a href="{{ route('todos.create') }}" class="btn-primary-micro" role="button" aria-label="Create your first todo">
                    <i class="fas fa-plus-circle"></i> Create First Todo
                  </a>
                </div>`;
            }
          }, 300);
        });
        document.getElementById('selectAll').checked = false;
      } else showMessage('Failed to delete todos', 'error');
    } catch {
      showMessage('Network error. Please try again.', 'error');
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    if(params.has('message')) {
      const msg = decodeURIComponent(params.get('message'));
      const type = params.get('type') || 'success';
      showMessage(msg, type, 2000);
    }
  });

  window.toggleFilters = toggleFilters;
  window.showMessage = showMessage;
  window.removeMessage = removeMessage;
  window.handleTodoAction = handleTodoAction;
  window.updateTodoActions = updateTodoActions;
  window.toggleTodoSelect = toggleTodoSelect;
  window.toggleAllCheckboxes = toggleAllCheckboxes;
  window.bulkComplete = bulkComplete;
  window.bulkDelete = bulkDelete;
})();
</script>
@endsection