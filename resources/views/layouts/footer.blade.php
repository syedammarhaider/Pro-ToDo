<footer class="py-5 mt-5" style="background: linear-gradient(135deg, var(--bs-card-bg) 0%, var(--bs-body-bg) 50%, var(--bs-card-bg) 100%); border-top: 4px solid var(--bs-btn-primary-bg); color: var(--bs-body-color); box-shadow: 0 -10px 30px var(--bs-shadow);">
    <div class="container">
        
        <div class="row gy-4">
            <!-- Brand Column -->
            <div class="col-lg-4">
                <div class="h-100 p-5 rounded-4 shadow-lg" style="background: linear-gradient(135deg, var(--bs-card-bg) 0%, rgba(79, 70, 229, 0.05) 100%); border: 2px solid var(--bs-border-color); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); backdrop-filter: blur(10px);">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle p-4 mb-4" style="background: var(--bs-gradient-primary); width: 100px; height: 100px; box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3);">
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
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    position: relative;
    overflow: hidden;
}

footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg,
        rgba(79, 70, 229, 0.02) 0%,
        rgba(245, 158, 11, 0.02) 25%,
        rgba(34, 197, 94, 0.02) 50%,
        rgba(239, 68, 68, 0.02) 75%,
        rgba(139, 92, 246, 0.02) 100%);
    pointer-events: none;
}

/* Subtle Hover Effects */
footer .rounded-4 {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

footer .rounded-4:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
}

footer a {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

footer a:hover {
    color: var(--bs-btn-primary-bg) !important;
    transform: translateX(5px);
    text-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
}

footer .rounded-circle {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

footer .rounded-circle:hover {
    background-color: var(--bs-btn-primary-bg) !important;
    color: var(--bs-card-bg) !important;
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
}

/* Smooth Transitions */
footer * {
    transition: all 0.3s ease;
}

/* Professional Layout */
footer .card {
    border: none;
    background: transparent;
}

footer .text-muted {
    color: var(--bs-text-muted) !important;
}

/* Stats Cards Animation */
footer .p-3 {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

footer .p-3:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

/* Heart Pulse Animation */
@keyframes heartPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

/* Responsive Design - Ultra Professional */
@media (max-width: 1200px) {
    footer .col-lg-4 {
        margin-bottom: 2rem;
    }
}

@media (max-width: 992px) {
    footer .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    footer .p-5 {
        padding: 2rem !important;
    }

    footer .display-6 {
        font-size: 2rem !important;
    }
}

@media (max-width: 768px) {
    footer {
        text-align: center;
        padding: 2rem 0;
    }

    footer .container {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    footer .row {
        flex-direction: column;
        gap: 2rem;
    }

    footer .col-lg-4 {
        margin-bottom: 0;
    }

    footer .p-5 {
        padding: 1.5rem !important;
        margin-bottom: 1rem;
    }

    footer .text-end {
        text-align: center !important;
        margin-top: 1rem;
    }

    footer .col-md-6 {
        text-align: center !important;
        margin-bottom: 1rem;
    }

    footer .lead {
        font-size: 0.9rem !important;
        line-height: 1.4;
    }

    footer .display-6 {
        font-size: 1.5rem !important;
    }

    footer .rounded-circle {
        width: 45px !important;
        height: 45px !important;
        padding: 0.75rem !important;
        margin: 0.25rem;
    }

    footer .btn-lg {
        padding: 0.75rem !important;
    }

    footer .d-flex.justify-content-center.gap-3 {
        justify-content: center;
        flex-wrap: wrap;
    }

    footer .list-unstyled li {
        margin-bottom: 0.75rem;
    }

    footer .p-3.rounded-3 {
        padding: 0.75rem !important;
        margin-bottom: 0.5rem;
    }

    footer .row.text-center.mb-4 .col-4 {
        margin-bottom: 1rem;
    }

    footer .mt-5.pt-4 {
        margin-top: 2rem !important;
        padding-top: 1.5rem !important;
    }

    footer .px-3.py-2 {
        padding: 0.5rem 1rem !important;
        margin: 0.25rem;
        display: inline-block;
    }
}

@media (max-width: 576px) {
    footer {
        padding: 1.5rem 0;
    }

    footer .container {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }

    footer .p-5 {
        padding: 1rem !important;
    }

    footer .display-6 {
        font-size: 1.25rem !important;
    }

    footer .lead {
        font-size: 0.8rem !important;
    }

    footer .rounded-circle {
        width: 40px !important;
        height: 40px !important;
        padding: 0.5rem !important;
    }

    footer .btn-lg {
        padding: 0.5rem !important;
    }

    footer .h3 {
        font-size: 1.25rem !important;
    }

    footer .h4 {
        font-size: 1.1rem !important;
    }

    footer .p-3.rounded-3 {
        padding: 0.5rem !important;
    }

    footer .row.text-center.mb-4 .col-4 {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }

    footer .mt-4 {
        margin-top: 1.5rem !important;
    }

    footer .mb-0.lead {
        font-size: 0.75rem !important;
    }
}

/* Touch Device Optimizations */
@media (hover: none) and (pointer: coarse) {
    footer .rounded-4:hover {
        transform: none;
    }

    footer a:hover {
        transform: none;
    }

    footer .rounded-circle:hover {
        transform: none;
    }

    footer .p-3:hover {
        transform: none;
    }
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    footer {
        border-top: 4px solid #000;
    }

    footer .rounded-4 {
        border: 2px solid #000;
    }
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    footer * {
        transition: none;
    }

    @keyframes heartPulse {
        0%, 100% { transform: none; }
        50% { transform: none; }
    }
}
</style>

</style>