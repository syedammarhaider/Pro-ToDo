<nav class="neo-nav fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md transition-all duration-300 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('todos.index') }}" class="flex items-center space-x-2 group">
                <div class="relative">
                    <i class="fas fa-tasks text-2xl bg-gradient-to-r from-indigo-500 to-teal-500 bg-clip-text text-transparent group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="text-xl font-bold">
                    <span class="text-gray-900">PRO</span>
                    <span class="bg-gradient-to-r from-indigo-500 to-teal-500 bg-clip-text text-transparent">TODO</span>
                </span>
            </a>
            
            <!-- Mobile Toggle -->
            <button class="mobile-toggle md:hidden w-10 h-10 flex flex-col justify-center items-center space-y-1.5 focus:outline-none">
                <span class="w-6 h-0.5 bg-gray-600 transition-all duration-300"></span>
                <span class="w-6 h-0.5 bg-gray-600 transition-all duration-300"></span>
                <span class="w-6 h-0.5 bg-gray-600 transition-all duration-300"></span>
            </button>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <!-- Navigation Links -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('todos.index') }}" 
                       class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200
                              {{ request()->routeIs('todos.index') 
                                 ? 'bg-indigo-50 text-indigo-600' 
                                 : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">
                        <i class="fas fa-list-check mr-2"></i>Dashboard
                    </a>
                    
                    <a href="{{ route('todos.index') }}#analytics" 
                       class="px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-indigo-600 rounded-lg transition-all duration-200">
                        <i class="fas fa-chart-simple mr-2"></i>Analytics
                    </a>
                    
                    <a href="{{ route('todos.create') }}" 
                       class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-teal-500 rounded-lg hover:from-indigo-600 hover:to-teal-600 transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus-circle mr-2"></i>New Task
                    </a>
                </div>
                
                <!-- Search Form -->
                <form action="{{ route('todos.index') }}" method="GET" class="relative">
                    <div class="flex items-center">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search tasks..." 
                               class="w-64 pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                        <i class="fas fa-search absolute left-3 text-gray-400 text-sm"></i>
                        <button type="submit" class="sr-only">Search</button>
                    </div>
                </form>
                
                <!-- User Menu -->
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-teal-500 rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 translate-y-2">
                            <div class="p-3 border-b border-gray-100">
                                <p class="text-xs text-gray-500">Signed in as</p>
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-user-cog w-4"></i>
                                <span>Profile Settings</span>
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                    <i class="fas fa-sign-out-alt w-4"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-teal-500 rounded-lg hover:from-indigo-600 hover:to-teal-600 transition-all duration-200 shadow-md hover:shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu hidden md:hidden absolute top-16 left-0 right-0 bg-white border-b border-gray-100 shadow-lg">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('todos.index') }}" 
               class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('todos.index') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-list-check w-5"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('todos.index') }}#analytics" 
               class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                <i class="fas fa-chart-simple w-5"></i>
                <span>Analytics</span>
            </a>
            
            <a href="{{ route('todos.create') }}" 
               class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-500 to-teal-500">
                <i class="fas fa-plus-circle w-5"></i>
                <span>New Task</span>
            </a>
            
            <div class="border-t border-gray-100 my-2"></div>
            
            <!-- Mobile Search -->
            <form action="{{ route('todos.index') }}" method="GET" class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search tasks..." 
                       class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
            </form>
            
            <!-- Mobile User Menu -->
            @auth
                <div class="border-t border-gray-100 my-2"></div>
                <div class="px-3 py-2">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-teal-500 rounded-full flex items-center justify-center text-white">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-user-cog w-5"></i>
                        <span>Profile Settings</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="px-3 py-2 space-y-2">
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


<style>
    /* Mobile Toggle Animation */
    .mobile-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .mobile-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    
    .mobile-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }
    
    /* Navbar Scroll Effect */
    .neo-nav.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: var(--shadow-lg);
    }
    
    [data-theme="dark"] .neo-nav.scrolled {
        background: rgba(15, 23, 42, 0.98);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            mobileToggle.classList.toggle('active');
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Navbar Scroll Effect
    const navbar = document.querySelector('.neo-nav');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
    
    // Close mobile menu when clicking links
    const mobileLinks = document.querySelectorAll('.mobile-menu a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (mobileToggle && mobileMenu) {
                mobileToggle.classList.remove('active');
                mobileMenu.classList.add('hidden');
            }
        });
    });
});
</script>