<nav class="neo-nav">
    <div class="neo-nav-container">
        <!-- Logo -->
        <a href="{{ route('todos.index') }}" class="neo-logo">
            <i class="fas fa-tasks"></i>
            <span>PRO<span class="text-gradient">TODO</span></span>
        </a>
        
        <!-- Mobile Toggle -->
        <button class="neo-mobile-toggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <!-- Navigation Links -->
        <div class="neo-nav-links">
            <ul class="neo-nav-menu">
                <li>
                    <a href="{{ route('todos.index') }}" class="neo-nav-link {{ request()->routeIs('todos.index') ? 'active' : '' }}">
                        <i class="fas fa-list-check me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="neo-nav-link" data-bs-toggle="collapse" data-bs-target="#stats">
                        <i class="fas fa-chart-simple me-2"></i> Analytics
                    </a>
                </li>
                <li>
                    <a href="{{ route('todos.create') }}" class="neo-nav-link">
                        <i class="fas fa-plus-circle me-2"></i> New Todo
                    </a>
                </li>
            </ul>
            
            <!-- Search Form -->
            <form class="neo-search" action="{{ route('todos.index') }}" method="GET">
                <input type="text" 
                       class="neo-search-input" 
                       name="search" 
                       placeholder="Search todos..."
                       value="{{ request('search') }}"
                       aria-label="Search todos">
                <button type="submit" class="neo-search-btn">
                    <i class="fas fa-search"></i>
                    <span class="hidden sm:inline">Search</span>
                </button>
            </form>
            
            <!-- User Authentication -->
            @auth
                <div class="neo-dropdown">
                    <button class="neo-dropdown-btn">
                        <i class="fas fa-circle-user"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down ms-1"></i>
                    </button>
                    
                    <div class="neo-dropdown-menu">
                        <div class="px-4 py-3 border-bottom">
                            <p class="text-sm text-gray-500">Signed in as</p>
                            <p class="font-semibold text-gray-800">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <a href="{{ route('profile.edit') }}" class="neo-dropdown-item">
                            <i class="fas fa-user-gear"></i>
                            Profile Settings
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="neo-dropdown-item w-full text-left">
                                <i class="fas fa-arrow-right-from-bracket"></i>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="neo-nav-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient text-white px-4 py-2 rounded-full font-semibold hover-lift hover-scale">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<!-- Statistics Section (Enhanced) -->
<div class="collapse container mx-auto px-4 mb-8" id="stats">
    <div class="stats-grid">
        <div class="stat-card animate-slide-left">
            <div class="stat-icon primary">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-value">{{ App\Models\Todo::count() }}</div>
            <div class="stat-label">Total Tasks</div>
        </div>
        
        <div class="stat-card animate-slide-left" style="animation-delay: 0.1s">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value">{{ App\Models\Todo::completed()->count() }}</div>
            <div class="stat-label">Completed</div>
        </div>
        
        <div class="stat-card animate-slide-right" style="animation-delay: 0.2s">
            <div class="stat-icon warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value">{{ App\Models\Todo::active()->count() }}</div>
            <div class="stat-label">In Progress</div>
        </div>
        
        <div class="stat-card animate-slide-right" style="animation-delay: 0.3s">
            <div class="stat-icon danger">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-value">{{ App\Models\Todo::overdue()->count() }}</div>
            <div class="stat-label">Overdue</div>
        </div>
    </div>
</div>