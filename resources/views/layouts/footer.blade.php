<footer class="neo-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Brand -->
            <div class="footer-brand">
                <h3>
                    <i class="fas fa-tasks"></i>
                    <span>PRO TODO</span>
                </h3>
                <p>Professional Todo Management Application. Stay organized and productive with our advanced task management system.</p>
                
                <!-- Social -->
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-gradient-to-r hover:from-indigo-500 hover:to-teal-500 transition-all">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('todos.index') }}"><i class="fas fa-chevron-right text-xs"></i> All Tasks</a></li>
                    <li><a href="{{ route('todos.create') }}"><i class="fas fa-chevron-right text-xs"></i> Create New Task</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right text-xs"></i> Completed Tasks</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right text-xs"></i> Overdue Tasks</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right text-xs"></i> Categories</a></li>
                </ul>
            </div>
            
            <!-- Features -->
            <div class="footer-links">
                <h4>Features</h4>
                <ul>
                    <li class="text-gray-300"><i class="fas fa-check-circle text-green-400 mr-2"></i> Priority Levels</li>
                    <li class="text-gray-300"><i class="fas fa-check-circle text-green-400 mr-2"></i> Categories & Tags</li>
                    <li class="text-gray-300"><i class="fas fa-check-circle text-green-400 mr-2"></i> Due Dates & Reminders</li>
                    <li class="text-gray-300"><i class="fas fa-check-circle text-green-400 mr-2"></i> Drag & Drop Interface</li>
                    <li class="text-gray-300"><i class="fas fa-check-circle text-green-400 mr-2"></i> Real-time Updates</li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="footer-newsletter">
                <h4>Newsletter</h4>
                <p class="text-gray-300 text-sm">Subscribe to get updates on new features and productivity tips.</p>
                
                <form class="space-y-3">
                    <div class="relative">
                        <input type="email" placeholder="Enter your email" class="newsletter-input">
                        <i class="fas fa-envelope absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <button type="submit" class="newsletter-btn">
                        <i class="fas fa-paper-plane mr-2"></i> Subscribe
                    </button>
                </form>
                
                <p class="text-xs text-gray-400">
                    <i class="fas fa-shield-alt mr-1"></i> We respect your privacy. No spam.
                </p>
            </div>
        </div>
        
        <!-- Bottom -->
        <div class="footer-bottom">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} PRO TODO. All rights reserved.
            </p>
            <p class="text-sm text-gray-400 mt-2">
                Made with <i class="fas fa-heart text-red-500 animate-pulse-slow"></i> for productivity
            </p>
        </div>
    </div>
</footer>