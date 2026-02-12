<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('todos.index') }}" class="flex items-center space-x-2 group">
                    <div class="relative">
                        <i class="fas fa-tasks text-2xl bg-gradient-to-r from-indigo-500 to-teal-500 bg-clip-text text-transparent group-hover:scale-110 transition-transform"></i>
                    </div>
                    <span class="text-xl font-bold">
                        <span class="text-gray-900">PRO</span>
                        <span class="bg-gradient-to-r from-indigo-500 to-teal-500 bg-clip-text text-transparent">TODO</span>
                    </span>
                </a>
                
                <!-- Breadcrumb -->
                @hasSection('breadcrumb')
                    <div class="hidden md:flex items-center ml-6">
                        <i class="fas fa-chevron-right text-xs text-gray-400 mx-2"></i>
                        <span class="text-sm text-gray-600">@yield('breadcrumb')</span>
                    </div>
                @endif
            </div>
            
            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                <!-- Quick Actions -->
                <div class="hidden md:flex items-center space-x-2">
                    <button class="p-2 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors relative" title="Notifications">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    
                    <button class="p-2 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Help">
                        <i class="fas fa-question-circle"></i>
                    </button>
                    
                    <button class="p-2 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Settings">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
                
                <!-- User Menu -->
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-teal-500 rounded-full flex items-center justify-center text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden md:inline text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                        </button>
                        
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 translate-y-2">
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-teal-500 rounded-lg hover:from-indigo-600 hover:to-teal-600">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>

<style>
    /* Header Animations */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    /* Dropdown Animation */
    .group:hover .group-hover\:translate-y-0 {
        transform: translateY(0);
    }
    
    /* Notification Badge */
    .absolute.top-1.right-1 {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
</style>