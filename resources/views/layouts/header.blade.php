<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg mb-4">

    <div class="container">

        <!-- Logo/Brand Name -->
        <a class="navbar-brand" href="{{ route('todos.index') }}">
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
                    <a class="nav-link" href="{{ route('todos.index') }}">
                        <i class="fas fa-home me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.show') }}">
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
                <button class="btn btn-outline-light btn-sm" id="themeToggle" title="Toggle theme">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
            </div>

            <!-- User Authentication Links -->
            @auth
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
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
    
    // Get current theme
    const currentTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-theme', currentTheme);
    updateThemeIcon(currentTheme);
    
    // Toggle theme
    themeToggle.addEventListener('click', function() {
        const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
    });
    
    function updateThemeIcon(theme) {
        if (theme === 'dark') {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        } else {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
    }
});
</script>