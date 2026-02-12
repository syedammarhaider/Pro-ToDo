<footer class="position-relative py-5 mt-5 overflow-hidden" style="background: linear-gradient(135deg, var(--bs-card-bg) 0%, var(--bs-body-bg) 50%, var(--bs-card-bg) 100%); border-top: 4px solid var(--bs-btn-primary-bg); color: var(--bs-body-color); box-shadow: 0 -10px 30px var(--bs-shadow);">
    <!-- Animated Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-3" style="background: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 200 200\"><defs><pattern id=\"grid\" width=\"20\" height=\"20\" patternUnits=\"userSpaceOnUse\"><path d=\"M 20 0 L 0 0 0 20\" fill=\"none\" stroke=\"var(--bs-border-color)\" stroke-width=\"0.3\"/></pattern></defs><rect width=\"200\" height=\"200\" fill=\"url(%23grid)\"/></svg>'); z-index: 0;">
    </div>
    
    <!-- Animated Particles -->
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="z-index: 0;">
        <div class="particle" style="position: absolute; top: 10%; left: 10%; width: 4px; height: 4px; background: var(--bs-btn-primary-bg); border-radius: 50%; animation: particleFloat 15s infinite linear;"></div>
        <div class="particle" style="position: absolute; top: 20%; left: 80%; width: 3px; height: 3px; background: var(--bs-btn-primary-bg); border-radius: 50%; animation: particleFloat 20s infinite linear 2s;"></div>
        <div class="particle" style="position: absolute; top: 60%; left: 20%; width: 5px; height: 5px; background: var(--bs-btn-primary-bg); border-radius: 50%; animation: particleFloat 18s infinite linear 4s;"></div>
    </div>
    
    <div class="container position-relative">
        <!-- Floating Elements -->
        <div class="position-absolute top-0 end-0 d-none d-lg-block">
            <div class="bg-gradient-primary text-white rounded-circle p-4 mb-3 shadow-xl" style="animation: float 8s ease-in-out infinite; box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);">
                <i class="fas fa-rocket fa-xl"></i>
            </div>
            <div class="bg-gradient-warning text-white rounded-circle p-3 mb-3 shadow-xl" style="animation: float 8s ease-in-out infinite 2s; box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);">
                <i class="fas fa-star fa-lg"></i>
            </div>
            <div class="bg-gradient-success text-white rounded-circle p-3 shadow-xl" style="animation: float 8s ease-in-out infinite 4s; box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);">
                <i class="fas fa-check fa-lg"></i>
            </div>
        </div>
        
        <div class="row gy-4">
            <!-- Brand Column -->
            <div class="col-lg-4">
                <div class="h-100 p-5 rounded-4 shadow-lg" style="background: linear-gradient(135deg, var(--bs-card-bg) 0%, rgba(79, 70, 229, 0.05) 100%); border: 2px solid var(--bs-border-color); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); backdrop-filter: blur(10px);">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle p-4 mb-4" style="background: var(--bs-gradient-primary); width: 100px; height: 100px; box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3); animation: pulse 3s infinite;">
                            <i class="fas fa-tasks fa-3x text-white"></i>
                        </div>
                        <h3 class="mb-3">
                            <span class="text-primary fw-bold display-6">PRO</span>
                            <span class="text-warning fw-bold display-6">TODO</span>
                        </h3>
                        <p class="text-muted lead">
                            Professional Todo Management Application. Stay organized and productive with our advanced task management system.
                        </p>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-outline-secondary btn-lg rounded-circle p-3 shadow-sm" title="Facebook" style="transition: all 0.4s ease; border: 2px solid var(--bs-border-color);">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-lg rounded-circle p-3 shadow-sm" title="Twitter" style="transition: all 0.4s ease; border: 2px solid var(--bs-border-color);">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-lg rounded-circle p-3 shadow-sm" title="LinkedIn" style="transition: all 0.4s ease; border: 2px solid var(--bs-border-color);">
                            <i class="fab fa-linkedin-in fa-lg"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-lg rounded-circle p-3 shadow-sm" title="GitHub" style="transition: all 0.4s ease; border: 2px solid var(--bs-border-color);">
                            <i class="fab fa-github fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-4">
                <div class="h-100 p-5 rounded-4 shadow-lg" style="background: linear-gradient(135deg, var(--bs-card-bg) 0%, rgba(245, 158, 11, 0.05) 100%); border: 2px solid var(--bs-border-color); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); backdrop-filter: blur(10px);">
                    <h4 class="mb-4 text-center position-relative">
                        <span class="position-relative d-inline-block px-4 py-2 rounded-pill" style="background: var(--bs-gradient-primary); color: white; font-weight: 700; font-size: 1.25rem; box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);">
                            Quick Links
                        </span>
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="{{ route('todos.index') }}" class="text-decoration-none d-flex align-items-center p-3 rounded-3" style="color: var(--bs-body-color); transition: all 0.4s ease; border: 1px solid transparent;">
                                <i class="fas fa-chevron-right text-primary me-3"></i>
                                <span class="fw-semibold">All Tasks</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('todos.create') }}" class="text-decoration-none d-flex align-items-center p-3 rounded-3" style="color: var(--bs-body-color); transition: all 0.4s ease; border: 1px solid transparent;">
                                <i class="fas fa-chevron-right text-primary me-3"></i>
                                <span class="fw-semibold">Create New Task</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('profile.show') }}" class="text-decoration-none d-flex align-items-center p-3 rounded-3" style="color: var(--bs-body-color); transition: all 0.4s ease; border: 1px solid transparent;">
                                <i class="fas fa-chevron-right text-primary me-3"></i>
                                <span class="fw-semibold">My Profile</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="text-decoration-none d-flex align-items-center p-3 rounded-3" style="color: var(--bs-body-color); transition: all 0.4s ease; border: 1px solid transparent;">
                                <i class="fas fa-chevron-right text-primary me-3"></i>
                                <span class="fw-semibold">Completed Tasks</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Features & Stats -->
            <div class="col-lg-4">
                <div class="h-100 p-5 rounded-4 shadow-lg" style="background: linear-gradient(135deg, var(--bs-card-bg) 0%, rgba(34, 197, 94, 0.05) 100%); border: 2px solid var(--bs-border-color); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); backdrop-filter: blur(10px);">
                    <h4 class="mb-4 text-center position-relative">
                        <span class="position-relative d-inline-block px-4 py-2 rounded-pill" style="background: var(--bs-gradient-warning); color: white; font-weight: 700; font-size: 1.25rem; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);">
                            Features
                        </span>
                    </h4>
                    
                    <!-- Stats -->
                    <div class="row text-center mb-4">
                        <div class="col-4">
                            <div class="p-3 rounded-3" style="background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0.2) 100%); border: 1px solid rgba(79, 70, 229, 0.2);">
                                <h3 class="mb-1 text-primary fw-bold">128</h3>
                                <small class="text-muted fw-semibold">Tasks</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-3" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.2) 100%); border: 1px solid rgba(34, 197, 94, 0.2);">
                                <h3 class="mb-1 text-success fw-bold">95%</h3>
                                <small class="text-muted fw-semibold">Done</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-3" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.2) 100%); border: 1px solid rgba(245, 158, 11, 0.2);">
                                <h3 class="mb-1 text-warning fw-bold">24/7</h3>
                                <small class="text-muted fw-semibold">Support</small>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <div class="d-flex align-items-center p-2 rounded-2" style="color: var(--bs-body-color); background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.1);">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span class="fw-semibold">Priority Levels</span>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-center p-2 rounded-2" style="color: var(--bs-body-color); background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.1);">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span class="fw-semibold">Smart Categories</span>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-center p-2 rounded-2" style="color: var(--bs-body-color); background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.1);">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span class="fw-semibold">Real-time Updates</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="mt-5 pt-4" style="border-top: 2px solid var(--bs-border-color); background: linear-gradient(135deg, var(--bs-card-bg) 0%, rgba(79, 70, 229, 0.02) 100%); backdrop-filter: blur(10px);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 lead" style="color: var(--bs-text-muted); font-weight: 500;">
                        &copy; {{ date('Y') }} PRO TODO. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-decoration-none me-3 px-3 py-2 rounded-pill" style="color: var(--bs-text-muted); transition: all 0.4s ease; border: 1px solid var(--bs-border-color); font-weight: 500;">Privacy Policy</a>
                    <a href="#" class="text-decoration-none me-3 px-3 py-2 rounded-pill" style="color: var(--bs-text-muted); transition: all 0.4s ease; border: 1px solid var(--bs-border-color); font-weight: 500;">Terms of Service</a>
                    <a href="#" class="text-decoration-none px-3 py-2 rounded-pill" style="color: var(--bs-text-muted); transition: all 0.4s ease; border: 1px solid var(--bs-border-color); font-weight: 500;">Contact</a>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="mb-0 lead" style="color: var(--bs-text-muted); font-weight: 500;">
                    Made with <i class="fas fa-heart text-danger" style="animation: heartPulse 1.5s ease-in-out infinite; font-size: 1.2rem;"></i> for productivity
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
/* Ultra Professional Footer Styles */
footer {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

/* Card Hover Effects */
footer .rounded-4:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 40px var(--bs-shadow);
    border-color: var(--bs-btn-primary-bg);
}

/* Link Hover Effects */
footer a:hover {
    color: var(--bs-btn-primary-bg) !important;
    transform: translateX(8px) scale(1.05);
    border-color: var(--bs-btn-primary-bg) !important;
    background: rgba(79, 70, 229, 0.05) !important;
}

footer .rounded-circle:hover {
    background-color: var(--bs-btn-primary-bg) !important;
    color: var(--bs-card-bg) !important;
    transform: scale(1.1) rotate(360deg);
    border-color: var(--bs-btn-primary-bg) !important;
}

/* Floating Animation */
@keyframes float {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg) scale(1); 
        opacity: 0.8;
    }
    25% { 
        transform: translateY(-15px) rotate(90deg) scale(1.05); 
        opacity: 0.9;
    }
    50% { 
        transform: translateY(-25px) rotate(180deg) scale(1.1); 
        opacity: 1;
    }
    75% { 
        transform: translateY(-15px) rotate(270deg) scale(1.05); 
        opacity: 0.9;
    }
}

/* Pulse Animation */
@keyframes pulse {
    0%, 100% { 
        transform: scale(1); 
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3);
    }
    50% { 
        transform: scale(1.05); 
        box-shadow: 0 15px 40px rgba(79, 70, 229, 0.5);
    }
}

/* Heart Animation */
@keyframes heartPulse {
    0% { 
        transform: scale(1); 
        color: #ef4444;
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.5));
    }
    25% { 
        transform: scale(1.2); 
        color: #dc2626;
        filter: drop-shadow(0 0 15px rgba(220, 38, 38, 0.7));
    }
    50% { 
        transform: scale(1); 
        color: #ef4444;
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.5));
    }
    75% { 
        transform: scale(1.2); 
        color: #dc2626;
        filter: drop-shadow(0 0 15px rgba(220, 38, 38, 0.7));
    }
    100% { 
        transform: scale(1); 
        color: #ef4444;
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.5));
    }
}

/* Particle Animation */
@keyframes particleFloat {
    0% {
        transform: translateY(0px) translateX(0px);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100px) translateX(50px);
        opacity: 0;
    }
}

/* Smooth Transitions */
footer * {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Gradient Text Effects */
footer h4 span {
    position: relative;
    overflow: hidden;
}

footer h4 span::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Stats Card Effects */
footer .rounded-3 {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

footer .rounded-3:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Responsive Design */
@media (max-width: 992px) {
    footer .position-absolute {
        display: none !important;
    }
    
    footer .col-lg-4 {
        margin-bottom: 2rem;
    }
    
    footer .display-6 {
        font-size: 2rem !important;
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
    
    footer .lead {
        font-size: 1rem !important;
    }
    
    footer .rounded-circle {
        width: 40px !important;
        height: 40px !important;
        padding: 0.5rem !important;
    }
}
</style>
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