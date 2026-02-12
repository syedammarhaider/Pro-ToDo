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
                    
                    <a href="#stats" 
                       data-bs-toggle="collapse"
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
            
            <a href="#stats" 
               data-bs-toggle="collapse"
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

<!-- Statistics Section -->
<div class="collapse max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-8" id="stats">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        <!-- Total Tasks -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Total</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ App\Models\Todo::count() }}</h3>
            <p class="text-sm text-gray-600">Total Tasks</p>
            <div class="mt-4 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="w-full h-full bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full"></div>
            </div>
        </div>
        
        <!-- Completed Tasks -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Done</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ App\Models\Todo::completed()->count() }}</h3>
            <p class="text-sm text-gray-600">Completed Tasks</p>
            @php $total = App\Models\Todo::count(); $completed = App\Models\Todo::completed()->count(); $percentage = $total > 0 ? ($completed / $total) * 100 : 0; @endphp
            <div class="mt-4 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full" style="width: {{ $percentage }}%"></div>
            </div>
        </div>
        
        <!-- Active Tasks -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-yellow-600 bg-yellow-50 px-3 py-1 rounded-full">Active</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ App\Models\Todo::active()->count() }}</h3>
            <p class="text-sm text-gray-600">In Progress</p>
            @php $active = App\Models\Todo::active()->count(); $percentage_active = $total > 0 ? ($active / $total) * 100 : 0; @endphp
            <div class="mt-4 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full" style="width: {{ $percentage_active }}%"></div>
            </div>
        </div>
        
        <!-- Overdue Tasks -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-red-600 bg-red-50 px-3 py-1 rounded-full">Urgent</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ App\Models\Todo::overdue()->count() }}</h3>
            <p class="text-sm text-gray-600">Overdue Tasks</p>
            @php $overdue = App\Models\Todo::overdue()->count(); $percentage_overdue = $total > 0 ? ($overdue / $total) * 100 : 0; @endphp
            <div class="mt-4 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-red-500 to-pink-600 rounded-full" style="width: {{ $percentage_overdue }}%"></div>
            </div>
        </div>
    </div>
</div>

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
    .neo-nav.bg-white\/98 {
        background: rgba(255, 255, 255, 0.98);
    }
</style>