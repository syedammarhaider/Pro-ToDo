<nav class="navbar navbar-expand-lg navbar-dark shadow-lg mb-4" style="background-color: var(--bs-navbar-bg) !important;">

    <div class="container">

        <!-- Logo/Brand Name -->
        <a class="navbar-brand" href="{{ route('todos.index') }}" style="color: var(--bs-navbar-color) !important;">
            <i class="fas fa-tasks me-2"></i>
            <strong>PRO TODO</strong>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Navigation Links -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('todos.index') }}" style="color: var(--bs-navbar-color) !important;">
                        <i class="fas fa-home me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.show') }}" style="color: var(--bs-navbar-color) !important;">
                        <i class="fas fa-user me-1"></i> Profile
                    </a>
                </li>
            </ul>

            <!-- Search Form -->
            <form class="d-flex me-3" action="{{ route('todos.index') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           class="form-control"
                           name="search"
                           placeholder="Search todos..."
                           value="{{ request('search') }}">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Dark/Light Mode Toggle -->
            <div class="d-flex align-items-center me-3">
                <button class="btn btn-outline-light btn-sm" id="themeToggle" title="Toggle theme" style="border: 2px solid var(--bs-navbar-color); color: var(--bs-navbar-color); transition: all 0.3s ease;">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
            </div>

            <!-- User Authentication Links -->
            @auth
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: 2px solid var(--bs-navbar-color); color: var(--bs-navbar-color);">
                        <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="fas fa-user me-1"></i>View Profile
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-edit me-1"></i>Edit Profile
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2" style="border: 2px solid var(--bs-navbar-color); color: var(--bs-navbar-color);">
                    <i class="fas fa-sign-in-alt me-1"></i>Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus me-1"></i>Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Theme Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const html = document.documentElement;
    
    // Set initial theme
    const currentTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-theme', currentTheme);
    updateThemeIcon(currentTheme);
    
    // Theme toggle functionality
    if (themeToggle && themeIcon) {
        themeToggle.addEventListener('click', function() {
            const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
            
            // Show success message
            if (window.showMessage) {
                window.showMessage(`${newTheme.charAt(0).toUpperCase() + newTheme.slice(1)} mode activated`, 'success', 2000);
            }
        });
    }
    
    function updateThemeIcon(theme) {
        if (themeIcon) {
            themeIcon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
    }
});
</script>