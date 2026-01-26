@extends('layouts.app')

@section('title', 'All Todos - Professional Todo App')

@section('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
:root {
  --bg-sidebar:#04123d;--bg-main:#0f1a4d;--card-dark:#091236;--text-primary:#fff;--text-secondary:#b2b9d1;
  --accent-pink:#eb00ff;--accent-blue:#007bff;--accent-cyan:#00d2ff;--accent-red:#ff4b5c;--accent-yellow:#ffc107;
  --accent-green:#00ff88;--accent-purple:#9d4edd;--accent-orange:#ff6b35;--glass-bg:rgba(9,18,54,0.75);
  --glass-border:rgba(255,255,255,0.1);
}
*{margin:0;padding:0;box-sizing:border-box;}
body {
  background: linear-gradient(135deg,var(--bg-main) 0%,#1a2a6c 50%,var(--card-dark) 100%);
  color: var(--text-primary);
  font-family:'Inter',sans-serif;
  letter-spacing:-0.01em;
  min-height:100vh;overflow-x:hidden;position:relative;
}
body::before {
  content: '';
  position: fixed;top:0;left:0;width:100%;height:100%;
  background-image:
    radial-gradient(circle at 20% 80%,rgba(0,210,255,0.1) 0%,transparent 50%),
    radial-gradient(circle at 80% 20%,rgba(235,0,255,0.1) 0%,transparent 50%),
    radial-gradient(circle at 40% 40%,rgba(0,255,136,0.05) 0%,transparent 50%);
  z-index:-1;
}
.glass-effect {
  background: var(--glass-bg);
  backdrop-filter: blur(25px) saturate(180%);
  -webkit-backdrop-filter: blur(25px) saturate(180%);
  border:1.5px solid var(--glass-border);
  border-radius:28px;
  box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5), inset 0 1px 0 0 rgba(255,255,255,0.1);
}
.page-header {
  margin-bottom:1.5rem;
  transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
  background: rgba(255,255,255,0.04);
  backdrop-filter: blur(15px);
  -webkit-backdrop-filter: blur(15px);
  border-radius: 20px;
  padding: 0.8rem 1.25rem;
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 8px 32px 0 rgba(0,0,0,0.3);
  margin-bottom: 2rem;
}
.page-header .d-flex {
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: nowrap !important;
  align-items: center !important;
  justify-content: space-between !important;
  width: 100%;
  gap: 2rem;
}
.page-header h1 {
  color: #fff !important;
  font-weight: 700;
  font-size: 2.25rem;
  margin-bottom: 0;
  display: flex;
  align-items: center;
  gap: 12px;
  white-space: nowrap;
}
.page-header h1 i {
  color: #0070f3;
  filter: drop-shadow(0 0 8px rgba(0,112,243,0.6));
  flex-shrink: 0;
}
.page-header .badge {
  background: #f81ce5 !important;
  color: #fff !important;
  font-size: 1.25rem !important;
  font-weight: 900 !important;
  padding: 0.4rem 0.9rem !important;
  border-radius: 14px;
  box-shadow: 0 0 15px rgba(248,28,229,0.6);
  border: none;
  margin-left: 10px;
  display: inline-block !important;
  flex-shrink: 0 !important;
  line-height: 1;
  visibility: visible !important;
  opacity: 1 !important;
  position: relative !important;
  z-index: 10 !important;
}
.btn-primary-micro {
  background: linear-gradient(135deg,#f81ce5,#7000ff);
  color: #fff !important;
  padding: 0.7rem 1.1rem;
  border-radius: 14px;
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  white-space: nowrap;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(248,28,229,0.3);
  margin-left: 15px;
  flex-shrink: 0;
  border: none;
  position: relative;
  overflow: hidden;
}
.btn-primary-micro::before {
  content: '';
  position: absolute;
  top: 0; left: -100%;
  width: 100%; height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: 0.5s;
}
.btn-primary-micro:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 12px 25px rgba(248,28,229,0.5);
}
.btn-primary-micro:hover::before {
  left: 100%;
}
.message-container {
  position: fixed;
  top: 20px; right: 20px;
  z-index: 99999;
  display: flex;
  flex-direction: column;
  gap: 12px;
  max-width: 380px;
  width: 100%;
  pointer-events: none;
}
.message {
  background: var(--glass-bg);
  backdrop-filter: blur(20px);
  border: 1.5px solid var(--glass-border);
  border-radius: 20px;
  padding: 1.25rem 1.5rem;
  box-shadow: 0 20px 40px rgba(0,0,0,0.4);
  transform: translateX(120%);
  transition: transform 0.5s cubic-bezier(0.68,-0.55,0.265,1.55);
  pointer-events: all;
  position: relative;
  overflow: hidden;
  border-left: 5px solid;
  animation: messageFloat 3s ease-in-out infinite;
}
.message.show {
  transform: translateX(0);
}
.message.success {
  border-left-color: var(--accent-green);
  background: linear-gradient(135deg, rgba(0,255,136,0.1), rgba(9,18,54,0.8));
}
.message.error {
  border-left-color: var(--accent-red);
  background: linear-gradient(135deg, rgba(255,75,92,0.1), rgba(9,18,54,0.8));
}
.message.info {
  border-left-color: var(--accent-cyan);
  background: linear-gradient(135deg, rgba(0,210,255,0.1), rgba(9,18,54,0.8));
}
.message.warning {
  border-left-color: var(--accent-yellow);
  background: linear-gradient(135deg, rgba(255,193,7,0.1), rgba(9,18,54,0.8));
}
.message::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
}
.message-content {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.message-icon {
  font-size: 1.5rem;
  min-width: 40px; height: 40px;
  background: rgba(255,255,255,0.1);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.message.success .message-icon {
  color: var(--accent-green);
}
.message.error .message-icon {
  color: var(--accent-red);
}
.message.info .message-icon {
  color: var(--accent-cyan);
}
.message.warning .message-icon {
  color: var(--accent-yellow);
}
.message-text h5 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0.25rem;
  color: white;
}
.message-text p {
  font-size: 0.875rem;
  color: var(--text-secondary);
  margin: 0;
  line-height: 1.4;
}
.message-close {
  position: absolute;
  top: 12px; right: 12px;
  background: rgba(255,255,255,0.1);
  border: none;
  color: var(--text-secondary);
  width: 24px; height: 24px;
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  font-size: 0.75rem;
  transition: all 0.2s;
}
.message-close:hover {
  background: rgba(255,255,255,0.2);
  color: white;
}
@keyframes messageFloat {
  0%, 100% { transform: translateX(0) translateY(0); }
  50% { transform: translateX(0) translateY(-5px); }
}
.filters-card {
  margin-bottom: 1.5rem;
  transition: all 0.3s;
}
.filters-collapsed {
  padding: 0.75rem !important;
}
.filter-toggle-btn {
  background: rgba(255,255,255,0.05);
  border: 1.5px solid var(--glass-border);
  border-radius: 16px;
  color: var(--text-secondary);
  padding: 0.5rem 1rem;
  font-size: 0.85rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s;
  cursor: pointer;
}
.filter-toggle-btn:hover {
  background: rgba(255,255,255,0.1);
  color: white;
  transform: translateY(-1px);
}
.form-control-micro, .form-select-micro {
  background: rgba(255,255,255,0.07);
  border: 1.5px solid rgba(255,255,255,0.12);
  color: white;
  border-radius: 14px;
  padding: 0.6rem 1rem;
  font-size: 0.875rem;
  height: 42px;
}
.form-control-micro:focus, .form-select-micro:focus {
  background: rgba(255,255,255,0.12);
  border-color: var(--accent-cyan);
  box-shadow: 0 0 0 0.25rem rgba(0,210,255,0.2);
  color: white;
}
.todo-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  animation: slideUp 0.5s ease-out;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .todo-grid {
    gap: 12px;
  }
}

/* Mobile layout - new pattern */
@media (max-width: 576px) {
  .todo-grid {
    gap: 10px;
  }
  .todo-header-micro {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.3rem;
    margin-bottom: 0.3rem;
  }
  
  .todo-checkbox-micro {
    position: relative;
    top: 0;
    left: 0;
    width: 14px !important;
    height: 14px !important;
    margin-bottom: 0.2rem;
  }
  
  .todo-title-micro {
    font-size: 0.6rem !important;
    font-weight: 600 !important;
    margin-bottom: 0.3rem !important;
    text-align: left;
    padding: 0 !important;
    line-height: 1.2;
  }
  
  .todo-actions-micro {
    justify-content: flex-start;
    order: 3;
    margin: 0.2rem 0;
    gap: 0.4rem !important;
  }
  
  .todo-actions-micro .btn-micro {
    width: 22px !important;
    height: 22px !important;
    min-width: 22px !important;
    font-size: 0.6rem !important;
    padding: 0.3rem !important;
    margin: 0 0.2rem !important;
  }
  
  .todo-footer-micro {
    flex-direction: column;
    align-items: flex-start;
    padding-top: 0.3rem !important;
    gap: 0.2rem;
  }
  
  .todo-meta-micro {
    order: 4;
    gap: 0.15rem !important;
    margin-bottom: 0.2rem;
  }
  
  .priority-badge-micro,
  .category-tag-micro,
  .due-date-micro {
    font-size: 0.35rem !important;
    padding: 0.05rem 0.2rem !important;
    margin-right: 0.15rem !important;
    border-radius: 6px !important;
  }
  
  .todo-footer-micro a {
    order: 5;
    align-self: center;
    margin-top: 0.2rem;
    width: 100%;
    text-align: center;
  }
  
  .todo-footer-micro a small {
    padding: 0.3rem 0.8rem !important;
    font-size: 0.6rem !important;
    font-weight: 600 !important;
    background: linear-gradient(135deg, var(--accent-purple), var(--accent-pink));
    border-radius: 12px !important;
    color: white !important;
    text-decoration: none !important;
  }
  
  .todo-item-micro {
    padding: 0.4rem !important;
    min-height: 90px !important;
    text-align: left;
  }
}
.todo-item-micro {
  background: linear-gradient(145deg,rgba(13,23,66,0.9),rgba(9,18,54,0.9));
  border-radius: 20px;
  padding: 1rem !important;
  transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
  border-left: 4px solid;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  min-height: 120px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.todo-item-micro:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05);
}
.todo-item-micro.low {
  border-left-color: var(--accent-green);
}
.todo-item-micro.medium {
  border-left-color: var(--accent-yellow);
}
.todo-item-micro.high {
  border-left-color: var(--accent-red);
}
.todo-item-micro.completed {
  opacity: 0.8;
  background: linear-gradient(145deg,rgba(10,15,40,0.9),rgba(5,10,30,0.9));
}
.todo-item-micro.completed .todo-title-micro {
  text-decoration: line-through;
  opacity: 0.6;
  color: rgba(255,255,255,0.7);
}
.todo-item-micro.completed .priority-badge-micro,
.todo-item-micro.completed .category-tag-micro,
.todo-item-micro.completed .due-date-micro {
  opacity: 0.7;
}
.todo-header-micro {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-bottom: 0.75rem;
  gap: 0.75rem;
}
.todo-checkbox-micro {
  width: 18px !important;
  height: 18px !important;
  margin-top: 2px;
  background: rgba(255,255,255,0.1);
  border: 2px solid rgba(255,255,255,0.3);
  border-radius: 6px;
  cursor: pointer;
}
.todo-checkbox-micro:checked {
  background-color: var(--accent-pink);
  border-color: var(--accent-pink);
}
.todo-title-micro {
  font-size: 0.75rem;
  font-weight: 600;
  line-height: 1.3;
  color: white;
  flex: 1;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  margin-bottom: 0.5rem;
  padding: 0.2rem 0;
}
.todo-actions-micro {
  display: flex;
  gap: 0.4rem;
}
.todo-actions-micro .btn-micro {
  width: 28px;
  height: 28px;
  min-width: 28px;
  padding: 0;
  border-radius: 50% !important;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  transition: all 0.2s;
}
.todo-actions-micro .btn-micro:hover {
  transform: scale(1.15);
  border-color: rgba(255,255,255,0.3);
}
.todo-footer-micro {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
  padding-top: 0.75rem;
  border-top: 1px solid rgba(255,255,255,0.05);
}
.todo-meta-micro {
  display: flex;
  align-items: center;
  gap: 0.2rem;
  flex-wrap: nowrap;
  overflow-x: auto;
  margin-bottom: 0.3rem;
}
.priority-badge-micro {
  font-size: 0.45rem;
  padding: 0.1rem 0.4rem;
  border-radius: 8px;
  font-weight: 600;
  text-transform: uppercase;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  margin-right: 0.3rem;
}
.category-tag-micro {
  font-size: 0.45rem;
  padding: 0.1rem 0.4rem;
  background: rgba(0,210,255,0.15);
  border-radius: 8px;
  color: var(--accent-cyan);
  border: 1px solid rgba(0,210,255,0.3);
  margin-right: 0.3rem;
}
.due-date-micro {
  font-size: 0.45rem;
  font-weight: 500;
  color: white;
  padding: 0.1rem 0.4rem;
  background: rgba(255,255,255,0.1);
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.2);
  margin-right: 0.3rem;
}
.due-date-micro.overdue {
  color: var(--accent-red) !important;
  animation: pulse 2s infinite;
}
@keyframes slideUp {
  from {opacity: 0; transform: translateY(30px);}
  to {opacity: 1; transform: translateY(0);}
}
@keyframes pulse {
  0%, 100% {opacity: 1;}
  50% {opacity: 0.7;}
}
.empty-state-micro {
  padding: 3rem 1.5rem;
  text-align: center;
}
.empty-icon-micro {
  font-size: 3.5rem;
  background: linear-gradient(135deg, var(--accent-cyan) 0%, var(--accent-pink) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 1rem;
  display: inline-block;
  animation: float 3s ease-in-out infinite;
}
.empty-state-micro h5 {
  font-size: 1.1rem;
  color: white;
  margin-bottom: 0.5rem;
}
.empty-state-micro p {
  color: var(--text-secondary);
  font-size: 0.9rem;
  margin-bottom: 1.5rem;
}
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}
.visually-hidden {
  position: absolute;
  width: 1px; height: 1px;
  padding: 0; margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  white-space: nowrap;
  border: 0;
}
.text-truncate-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.fade-in {
  animation: fadeIn 0.3s ease-out;
}
@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

/* Search Highlighting */
.search-highlight {
  background: linear-gradient(135deg, rgba(255,215,0,0.4), rgba(255,193,7,0.6));
  color: white;
  padding: 0.1rem 0.2rem;
  border-radius: 4px;
  font-weight: 700;
  box-shadow: 0 0 8px rgba(255,215,0,0.5);
  animation: highlightPulse 2s ease-in-out infinite;
}

@keyframes highlightPulse {
  0%, 100% { 
    background: linear-gradient(135deg, rgba(255,215,0,0.4), rgba(255,193,7,0.6));
    box-shadow: 0 0 8px rgba(255,215,0,0.5);
  }
  50% { 
    background: linear-gradient(135deg, rgba(255,215,0,0.6), rgba(255,193,7,0.8));
    box-shadow: 0 0 12px rgba(255,215,0,0.7);
  }
}

/* Professional Numbered Pagination Styles */
.pagination-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  flex-wrap: wrap;
}

.pagination-nav {
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.pagination-link {
  background: rgba(255,255,255,0.1);
  color: white;
  border: 1px solid rgba(255,255,255,0.2);
  padding: 0.4rem 0.8rem;
  border-radius: 8px;
  font-size: 0.8rem;
  font-weight: 500;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 36px;
  height: 36px;
  transition: all 0.3s ease;
  backdrop-filter: blur(5px);
}

.pagination-link:hover {
  background: linear-gradient(135deg, var(--accent-purple), var(--accent-pink));
  border-color: transparent;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(248,28,229,0.4);
  text-decoration: none;
  color: white;
}

.pagination-link.active {
  background: linear-gradient(135deg, var(--accent-purple), var(--accent-pink));
  border-color: transparent;
  box-shadow: 0 4px 12px rgba(248,28,229,0.4);
  font-weight: 600;
}

.pagination-link.disabled {
  background: rgba(255,255,255,0.05);
  color: rgba(255,255,255,0.4);
  border-color: rgba(255,255,255,0.1);
  cursor: not-allowed;
  opacity: 0.6;
}

.pagination-link.disabled:hover {
  background: rgba(255,255,255,0.05);
  transform: none;
  box-shadow: none;
}

.pagination-ellipsis {
  color: rgba(255,255,255,0.6);
  padding: 0 0.5rem;
  display: flex;
  align-items: center;
  font-size: 0.8rem;
}

/* Mobile responsive pagination */
@media (max-width: 576px) {
  .pagination-link {
    padding: 0.3rem 0.6rem;
    font-size: 0.75rem;
    min-width: 32px;
    height: 32px;
  }
  
  .pagination-container {
    gap: 0.3rem;
  }
}
</style>
@endsection

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
            <div class="d-flex align-items-center gap-3">
                <h1 tabindex="0">
                    <span aria-label="{{ $todos->total() }} todos total"> Total Todos {{ $todos->total() }} </span>
                </h1>
            </div>
            <a href="{{ route('todos.create') }}" class="btn-primary-micro" role="button" aria-label="Create new todo">
                <i class="fas fa-plus-circle" aria-hidden="true"></i>
                <span class="d-none d-sm-inline">New Todo</span>
            </a>
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
                        <div class="col-12 col-md-6 col-lg-3">
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
                        <div class="col-12 col-md-6 col-lg-3">
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
                                            <button type="submit" class="btn-micro btn-success" title="Mark Complete" aria-pressed="false" onclick="handleTodoAction(this.closest('form'), 'complete', event); return false;">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            </form>
                                        @else
                                            <form action="{{ route('todos.incomplete', $todo) }}" method="POST" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="submit" class="btn-micro btn-warning" title="Mark Incomplete" aria-pressed="true" onclick="handleTodoAction(this.closest('form'), 'incomplete', event); return false;">
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
                                            <button type="submit" class="btn-micro btn-danger" onclick="handleTodoAction(this.closest('form'), 'delete', event); return false;" title="Delete">
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
                                        @if($todo->due_date)
                                            <span class="due-date-micro" style="color: white !important;">
                                                <i class="fas fa-calendar-day"></i> {{ $todo->due_date->format('M d') }}
                                                @if($todo->isOverdue())
                                                    <span style="color: var(--accent-red); font-weight: bold;">!</span>
                                                @endif
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
    document.querySelectorAll('.btn, .todo-item-micro').forEach(el => {
      el.addEventListener('click', e => {
        if(el.classList.contains('todo-item-micro') && ['INPUT','A','BUTTON'].includes(e.target.tagName)) return;
        const ripple = document.createElement('span');
        const rect = el.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        ripple.style.cssText = `
          position: absolute;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.4);
          transform: scale(0);
          animation: ripple 0.6s linear;
          width: ${size}px;
          height: ${size}px;
          left: ${x}px;
          top: ${y}px;
          pointer-events: none;`;
        el.style.position = 'relative';
        el.style.overflow = 'hidden';
        el.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
      });
    });
    if(!sessionStorage.getItem('welcomeShown')) {
      setTimeout(() => showMessage('Welcome to your todo manager! Tap todos to select multiple.', 'info', 2000), 1000);
      sessionStorage.setItem('welcomeShown', 'true');
    }
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