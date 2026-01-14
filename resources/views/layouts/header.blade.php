<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg mb-4">
    <div class="container">
        <!-- Logo/Brand Name - Logo ya brand ka naam -->
        <a class="navbar-brand" href="{{ route('todos.index') }}">
            <i class="fas fa-tasks me-2"></i>
            <strong>PRO TODO</strong>
        </a>

        <!-- Mobile Toggle Button - Mobile ke liye toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links - Navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('todos.index') ? 'active' : '' }}" 
                       href="{{ route('todos.index') }}">
                        <i class="fas fa-list me-1"></i> All Todos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('todos.create') ? 'active' : '' }}" 
                       href="{{ route('todos.create') }}">
                        <i class="fas fa-plus-circle me-1"></i> New Todo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#stats" data-bs-toggle="collapse">
                        <i class="fas fa-chart-bar me-1"></i> Statistics
                    </a>
                </li>
            </ul>

            <!-- Search Form - Search ka form -->
            <form class="d-flex me-3" action="{{ route('todos.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           placeholder="Search todos..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- User Info/Dark Mode - User info ya dark mode -->
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> User
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-moon me-2"></i> Dark Mode</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Statistics Section (Collapsible) - Statistics section (collapsible) -->
<div class="collapse container mb-4" id="stats">
    <div class="card glass-effect">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <div class="p-3 bg-primary bg-opacity-10 rounded">
                        <h3 class="text-primary">{{ App\Models\Todo::count() }}</h3>
                        <small class="text-muted">Total Todos</small>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="p-3 bg-success bg-opacity-10 rounded">
                        <h3 class="text-success">{{ App\Models\Todo::completed()->count() }}</h3>
                        <small class="text-muted">Completed</small>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="p-3 bg-warning bg-opacity-10 rounded">
                        <h3 class="text-warning">{{ App\Models\Todo::active()->count() }}</h3>
                        <small class="text-muted">Active</small>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="p-3 bg-danger bg-opacity-10 rounded">
                        <h3 class="text-danger">{{ App\Models\Todo::overdue()->count() }}</h3>
                        <small class="text-muted">Overdue</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>