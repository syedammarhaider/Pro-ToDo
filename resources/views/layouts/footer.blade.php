<footer class="bg-gradient-to-br from-gray-900 to-gray-800 text-white mt-auto">
    <!-- Wave Effect -->
    <div class="relative -mt-16">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full h-auto">
            <path fill="#0f172a" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
        </svg>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Brand Column -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-tasks text-2xl bg-gradient-to-r from-indigo-400 to-teal-400 bg-clip-text text-transparent"></i>
                    <span class="text-xl font-bold">
                        <span class="text-white">PRO</span>
                        <span class="bg-gradient-to-r from-indigo-400 to-teal-400 bg-clip-text text-transparent">TODO</span>
                    </span>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Professional Todo Management Application. Stay organized and productive with our advanced task management system.
                </p>
                
                <!-- Social Links -->
                <div class="flex space-x-4 pt-2">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold relative inline-block">
                    Quick Links
                    <span class="absolute -bottom-2 left-0 w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-teal-400"></span>
                </h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('todos.index') }}" class="text-gray-300 hover:text-white flex items-center space-x-2 group">
                            <i class="fas fa-chevron-right text-xs text-indigo-400 group-hover:translate-x-1 transition-transform"></i>
                            <span>All Tasks</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('todos.create') }}" class="text-gray-300 hover:text-white flex items-center space-x-2 group">
                            <i class="fas fa-chevron-right text-xs text-indigo-400 group-hover:translate-x-1 transition-transform"></i>
                            <span>Create New Task</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white flex items-center space-x-2 group">
                            <i class="fas fa-chevron-right text-xs text-indigo-400 group-hover:translate-x-1 transition-transform"></i>
                            <span>Completed Tasks</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white flex items-center space-x-2 group">
                            <i class="fas fa-chevron-right text-xs text-indigo-400 group-hover:translate-x-1 transition-transform"></i>
                            <span>Overdue Tasks</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white flex items-center space-x-2 group">
                            <i class="fas fa-chevron-right text-xs text-indigo-400 group-hover:translate-x-1 transition-transform"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Features -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold relative inline-block">
                    Features
                    <span class="absolute -bottom-2 left-0 w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-teal-400"></span>
                </h4>
                <ul class="space-y-3">
                    <li class="text-gray-300 flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>Priority Levels</span>
                    </li>
                    <li class="text-gray-300 flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>Categories & Tags</span>
                    </li>
                    <li class="text-gray-300 flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>Due Dates & Reminders</span>
                    </li>
                    <li class="text-gray-300 flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>Drag & Drop Interface</span>
                    </li>
                    <li class="text-gray-300 flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>Real-time Updates</span>
                    </li>
                    <li class="text-gray-300 flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>Analytics Dashboard</span>
                    </li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold relative inline-block">
                    Newsletter
                    <span class="absolute -bottom-2 left-0 w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-teal-400"></span>
                </h4>
                <p class="text-gray-300 text-sm">
                    Subscribe to get updates on new features and productivity tips.
                </p>
                
                <form class="space-y-3">
                    <div class="relative">
                        <input type="email" 
                               placeholder="Enter your email" 
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                        <i class="fas fa-envelope absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <button type="submit" 
                            class="w-full px-4 py-3 bg-gradient-to-r from-indigo-500 to-teal-500 text-white rounded-lg font-medium hover:from-indigo-600 hover:to-teal-600 transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Subscribe
                    </button>
                </form>
                
                <p class="text-xs text-gray-400">
                    <i class="fas fa-shield-alt mr-1"></i>
                    We respect your privacy. No spam.
                </p>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} PRO TODO. All rights reserved.
                </p>
                
                <div class="flex space-x-6">
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Contact</a>
                </div>
            </div>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Made with <i class="fas fa-heart text-red-500 animate-pulse-slow"></i> for productivity
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Footer Animation */
    .fa-heart.animate-pulse-slow {
        animation: heartPulse 2s infinite;
    }
    
    @keyframes heartPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
    
    /* Smooth Hover Effects */
    .bg-gray-800 {
        transition: all 0.3s ease;
    }
</style>