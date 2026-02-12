<footer class="position-relative py-5 mt-5 overflow-hidden" style="background: linear-gradient(135deg, var(--bs-card-bg) 0%, var(--bs-body-bg) 100%); border-top: 3px solid var(--bs-border-color); color: var(--bs-body-color);">
    <!-- Animated Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-5" style="background: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"var(--bs-border-color)\" stroke-width=\"0.5\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>'); z-index: 0;">
    </div>
    
    <div class="container position-relative">
        <!-- Floating Elements -->
        <div class="position-absolute top-0 end-0 d-none d-lg-block">
            <div class="bg-primary text-white rounded-circle p-3 mb-3 shadow-lg" style="animation: float 6s ease-in-out infinite;">
                <i class="fas fa-rocket fa-lg"></i>
            </div>
            <div class="bg-warning text-white rounded-circle p-3 mb-3 shadow-lg" style="animation: float 6s ease-in-out infinite 2s;">
                <i class="fas fa-star fa-lg"></i>
            </div>
            <div class="bg-success text-white rounded-circle p-3 shadow-lg" style="animation: float 6s ease-in-out infinite 4s;">
                <i class="fas fa-check fa-lg"></i>
            </div>
        </div>
        
        <div class="row gy-4">
            <!-- Brand Column -->
            <div class="col-lg-4">
                <div class="h-100 p-4 rounded-3 shadow-sm" style="background: var(--bs-card-bg); border: 1px solid var(--bs-border-color); transition: all 0.3s ease;">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle p-3 mb-3" style="background: var(--bs-gradient-primary); width: 80px; height: 80px;">
                            <i class="fas fa-tasks fa-2x text-white"></i>
                        </div>
                        <h4 class="mb-2">
                            <span class="text-primary fw-bold">PRO</span>
                            <span class="text-warning fw-bold">TODO</span>
                        </h4>
                        <p class="text-muted">
                            Professional Todo Management Application. Stay organized and productive with our advanced task management system.
                        </p>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Facebook" style="transition: all 0.3s ease;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Twitter" style="transition: all 0.3s ease;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="LinkedIn" style="transition: all 0.3s ease;">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="GitHub" style="transition: all 0.3s ease;">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-4">
                <div class="h-100 p-4 rounded-3 shadow-sm" style="background: var(--bs-card-bg); border: 1px solid var(--bs-border-color); transition: all 0.3s ease;">
                    <h5 class="mb-4 text-center position-relative">
                        <span class="position-relative d-inline-block px-3 py-1 rounded" style="background: var(--bs-gradient-primary); color: white;">
                            Quick Links
                        </span>
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="{{ route('todos.index') }}" class="text-decoration-none d-flex align-items-center p-2 rounded" style="color: var(--bs-body-color); transition: all 0.3s ease;">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                <span>All Tasks</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('todos.create') }}" class="text-decoration-none d-flex align-items-center p-2 rounded" style="color: var(--bs-body-color); transition: all 0.3s ease;">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                <span>Create New Task</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('profile.show') }}" class="text-decoration-none d-flex align-items-center p-2 rounded" style="color: var(--bs-body-color); transition: all 0.3s ease;">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="text-decoration-none d-flex align-items-center p-2 rounded" style="color: var(--bs-body-color); transition: all 0.3s ease;">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                <span>Completed Tasks</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Features & Stats -->
            <div class="col-lg-4">
                <div class="h-100 p-4 rounded-3 shadow-sm" style="background: var(--bs-card-bg); border: 1px solid var(--bs-border-color); transition: all 0.3s ease;">
                    <h5 class="mb-4 text-center position-relative">
                        <span class="position-relative d-inline-block px-3 py-1 rounded" style="background: var(--bs-gradient-warning); color: white;">
                            Features
                        </span>
                    </h5>
                    
                    <!-- Stats -->
                    <div class="row text-center mb-4">
                        <div class="col-4">
                            <div class="p-2 rounded" style="background: rgba(79, 70, 229, 0.1);">
                                <h4 class="mb-1 text-primary">128</h4>
                                <small class="text-muted">Tasks</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded" style="background: rgba(34, 197, 94, 0.1);">
                                <h4 class="mb-1 text-success">95%</h4>
                                <small class="text-muted">Done</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded" style="background: rgba(245, 158, 11, 0.1);">
                                <h4 class="mb-1 text-warning">24/7</h4>
                                <small class="text-muted">Support</small>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <div class="d-flex align-items-center" style="color: var(--bs-body-color);">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Priority Levels</span>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-center" style="color: var(--bs-body-color);">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Smart Categories</span>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-center" style="color: var(--bs-body-color);">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Due Dates & Reminders</span>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-center" style="color: var(--bs-body-color);">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Real-time Updates</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="mt-5 pt-4" style="border-top: 1px solid var(--bs-border-color); background: var(--bs-card-bg);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0" style="color: var(--bs-text-muted);">
                        &copy; {{ date('Y') }} PRO TODO. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-decoration-none me-3 px-2 py-1 rounded" style="color: var(--bs-text-muted); transition: all 0.3s ease;">Privacy Policy</a>
                    <a href="#" class="text-decoration-none me-3 px-2 py-1 rounded" style="color: var(--bs-text-muted); transition: all 0.3s ease;">Terms of Service</a>
                    <a href="#" class="text-decoration-none px-2 py-1 rounded" style="color: var(--bs-text-muted); transition: all 0.3s ease;">Contact</a>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <p class="mb-0" style="color: var(--bs-text-muted);">
                    Made with <i class="fas fa-heart text-danger" style="animation: heartPulse 1.5s ease-in-out infinite;"></i> for productivity
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
/* Footer Ultra Professional Styles */
footer {
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

/* Card Hover Effects */
footer .rounded-3:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px var(--bs-shadow);
}

/* Link Hover Effects */
footer a:hover {
    color: var(--bs-btn-primary-bg) !important;
    transform: translateX(5px);
}

footer .rounded:hover {
    background-color: var(--bs-text-muted) !important;
    color: var(--bs-card-bg) !important;
}

/* Floating Animation */
@keyframes float {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg); 
        opacity: 0.8;
    }
    50% { 
        transform: translateY(-20px) rotate(180deg); 
        opacity: 1;
    }
}

/* Heart Animation */
@keyframes heartPulse {
    0% { 
        transform: scale(1); 
        color: #ef4444;
    }
    25% { 
        transform: scale(1.1); 
        color: #dc2626;
    }
    50% { 
        transform: scale(1); 
        color: #ef4444;
    }
    75% { 
        transform: scale(1.1); 
        color: #dc2626;
    }
    100% { 
        transform: scale(1); 
        color: #ef4444;
    }
}

/* Smooth Transitions */
footer * {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Gradient Text Effects */
footer h5 span {
    position: relative;
    overflow: hidden;
}

footer h5 span::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Responsive Design */
@media (max-width: 992px) {
    footer .position-absolute {
        display: none !important;
    }
    
    footer .col-lg-4 {
        margin-bottom: 2rem;
    }
}

@media (max-width: 768px) {
    footer {
        text-align: center;
    }
    
    footer .text-end {
        text-align: center !important;
        margin-top: 1rem;
    }
    
    footer .row {
        flex-direction: column;
    }
    
    footer .col-md-6 {
        text-align: center !important;
        margin-bottom: 1rem;
    }
}

/* Smooth Scrollbar */
footer::-webkit-scrollbar {
    width: 8px;
}

footer::-webkit-scrollbar-track {
    background: var(--bs-card-bg);
}

footer::-webkit-scrollbar-thumb {
    background: var(--bs-border-color);
    border-radius: 4px;
}

footer::-webkit-scrollbar-thumb:hover {
    background: var(--bs-text-muted);
}
</style>