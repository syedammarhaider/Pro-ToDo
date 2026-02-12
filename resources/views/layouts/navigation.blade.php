<nav class="neo-nav" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('todos.index') }}" class="neo-logo">
                <i class="fas fa-tasks"></i>
                <span>
                    <span>PRO</span>
                    <span>TODO</span>
                </span>
            </a>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('todos.index') }}" class="neo-nav-link {{ request()->routeIs('todos.index') ? 'active' : '' }}">
                    <i class="fas fa-list-check mr-2"></i> Dashboard
                </a>
                
                <a href="#stats" data-bs-toggle="collapse" class="neo-nav-link">
                    <i class="fas fa-chart-simple mr-2"></i> Analytics
                </a>
                
                <a href="{{ route('todos.create') }}" class="create-btn">
                    <i class="fas fa-plus-circle mr-2"></i> New Task
                </a>
                
                <!-- Search -->
                <div class="neo-search">
                    <i class="fas fa-search"></i>
                    <form action="{{ route('todos.index') }}" method="GET">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search tasks..." 
                               class="neo-search-input">
                    </form>
                </div>
                
                <!-- User Menu -->
                @auth
                    <div class="relative group">
                        <button class="neo-dropdown-btn">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-teal-500 rounded-full flex items-center justify-center text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div class="neo-dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="neo-dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="neo-dropdown-item text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="neo-nav-link">Login</a>
                        <a href="{{ route('register') }}" class="create-btn">Register</a>
                    </div>
                @endauth
            </div>
            
            <!-- Mobile Toggle -->
            <button class="mobile-toggle" id="mobileToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu hidden" id="mobileMenu">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('todos.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('todos.index') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-list-check w-5"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="#stats" data-bs-toggle="collapse" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                <i class="fas fa-chart-simple w-5"></i>
                <span>Analytics</span>
            </a>
            
            <a href="{{ route('todos.create') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-500 to-teal-500">
                <i class="fas fa-plus-circle w-5"></i>
                <span>New Task</span>
            </a>
            
            <!-- Mobile Search -->
            <form action="{{ route('todos.index') }}" method="GET" class="relative mt-3">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search tasks..." 
                       class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500">
            </form>
            
            @auth
                <div class="border-t border-gray-200 my-2 pt-2">
                    <div class="px-3 py-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-teal-500 rounded-full flex items-center justify-center text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-user w-5"></i>
                        <span>Profile</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-200 my-2 pt-2 space-y-2">
                    <a href="{{ route('login') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-sign-in-alt w-5"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-500 to-teal-500">
                        <i class="fas fa-user-plus w-5"></i>
                        <span>Register</span>
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileMenu.classList.toggle('hidden');
            });
        }
        
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
</script>