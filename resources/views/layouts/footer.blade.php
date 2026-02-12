<footer class="text-center py-4 mt-5" style="background-color: var(--bs-card-bg); border-top: 1px solid var(--bs-border-color); color: var(--bs-body-color);">
    <div class="container">
        <div class="row">
            <!-- Brand Column -->
            <div class="col-lg-4 mb-4">
                <h5 class="mb-3">
                    <i class="fas fa-tasks text-primary me-2"></i>
                    <span class="text-primary fw-bold">PRO</span>
                    <span class="text-warning fw-bold">TODO</span>
                </h5>
                <p class="text-muted">
                    Professional Todo Management Application. Stay organized and productive with our advanced task management system.
                </p>
                
                <!-- Social Links -->
                <div class="mt-3">
                    <a href="#" class="btn btn-outline-secondary btn-sm me-2" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm me-2" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm me-2" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm" title="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-4 mb-4">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('todos.index') }}" class="text-decoration-none" style="color: var(--bs-body-color);">
                            <i class="fas fa-chevron-right text-primary me-2"></i>
                            All Tasks
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('todos.create') }}" class="text-decoration-none" style="color: var(--bs-body-color);">
                            <i class="fas fa-chevron-right text-primary me-2"></i>
                            Create New Task
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('profile.show') }}" class="text-decoration-none" style="color: var(--bs-body-color);">
                            <i class="fas fa-chevron-right text-primary me-2"></i>
                            My Profile
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-decoration-none" style="color: var(--bs-body-color);">
                            <i class="fas fa-chevron-right text-primary me-2"></i>
                            Completed Tasks
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Features -->
            <div class="col-lg-4 mb-4">
                <h5 class="mb-3">Features</h5>
                <ul class="list-unstyled">
                    <li class="mb-2" style="color: var(--bs-body-color);">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Priority Levels
                    </li>
                    <li class="mb-2" style="color: var(--bs-body-color);">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Categories & Tags
                    </li>
                    <li class="mb-2" style="color: var(--bs-body-color);">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Due Dates & Reminders
                    </li>
                    <li class="mb-2" style="color: var(--bs-body-color);">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Real-time Updates
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <hr class="my-4" style="border-color: var(--bs-border-color);">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted mb-0">
                    &copy; {{ date('Y') }} PRO TODO. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-end">
                <a href="#" class="text-decoration-none me-3" style="color: var(--bs-text-muted);">Privacy Policy</a>
                <a href="#" class="text-decoration-none me-3" style="color: var(--bs-text-muted);">Terms of Service</a>
                <a href="#" class="text-decoration-none" style="color: var(--bs-text-muted);">Contact</a>
            </div>
        </div>
        
        <div class="text-center mt-3">
            <p class="text-muted mb-0">
                Made with <i class="fas fa-heart text-danger"></i> for productivity
            </p>
        </div>
    </div>
</footer>

<style>
/* Footer Dark Mode Styles */
footer {
    transition: all 0.3s ease;
}

footer h5 {
    color: var(--bs-body-color);
    font-weight: 600;
}

footer a {
    transition: color 0.3s ease;
}

footer a:hover {
    color: var(--bs-btn-primary-bg) !important;
}

footer .btn-outline-secondary {
    border-color: var(--bs-text-muted);
    color: var(--bs-text-muted);
}

footer .btn-outline-secondary:hover {
    background-color: var(--bs-text-muted);
    border-color: var(--bs-text-muted);
    color: var(--bs-card-bg);
}

/* Heart Animation */
.fa-heart {
    animation: heartPulse 1.5s ease-in-out infinite;
}

@keyframes heartPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Responsive Footer */
@media (max-width: 768px) {
    footer {
        text-align: left;
    }
    
    footer .text-end {
        text-align: left !important;
        margin-top: 1rem;
    }
}
</style>