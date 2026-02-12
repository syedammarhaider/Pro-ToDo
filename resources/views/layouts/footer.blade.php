<footer class="neo-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <h3>
                    <i class="fas fa-tasks"></i>
                    PRO TODO
                </h3>
                <p class="text-gray-400 mb-4">
                    Professional Todo Management Application. Stay organized and productive with our advanced task management system.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li>
                        <a href="{{ route('todos.index') }}">
                            <i class="fas fa-chevron-right text-xs"></i>
                            All Tasks
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('todos.create') }}">
                            <i class="fas fa-chevron-right text-xs"></i>
                            Create New Task
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chevron-right text-xs"></i>
                            Completed Tasks
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chevron-right text-xs"></i>
                            Overdue Tasks
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chevron-right text-xs"></i>
                            Task Categories
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Features -->
            <div class="footer-links">
                <h4>Features</h4>
                <ul>
                    <li>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Priority Levels
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Categories & Tags
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Due Dates & Reminders
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Drag & Drop Interface
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Real-time Updates
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Analytics Dashboard
                    </li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="footer-newsletter">
                <h4>Stay Updated</h4>
                <p class="text-gray-400 text-sm mb-3">
                    Subscribe to our newsletter for tips and updates
                </p>
                <form class="newsletter-form">
                    <input type="email" 
                           class="newsletter-input" 
                           placeholder="Enter your email"
                           aria-label="Email for newsletter">
                    <button type="submit" class="newsletter-btn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-3">
                    <i class="fas fa-shield-alt me-1"></i>
                    We respect your privacy. No spam.
                </p>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">
                    &copy; {{ date('Y') }} Professional Todo App. All rights reserved.
                </p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Contact</a>
                </div>
            </div>
            <p class="text-sm mt-4">
                Made with <i class="fas fa-heart text-danger animate-pulse-slow"></i> for productivity
            </p>
        </div>
    </div>
</footer>