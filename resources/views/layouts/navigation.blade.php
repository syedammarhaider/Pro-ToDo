<nav class="glass-effect border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- App Title/Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('todos.index') }}" class="flex items-center gap-2 text-white hover:text-cyan-400 transition-colors">
                        <i class="fas fa-tasks text-2xl bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent"></i>
                        <span class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">Pro-ToDo</span>
                    </a>
                </div>
            </div>

            <!-- Simple Logout Button -->
            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-white/10 hover:bg-white/20 rounded-lg transition-all duration-200">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
