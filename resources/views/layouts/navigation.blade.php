<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <title>@yield('title', 'Professional Todo App')</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <style>
        {!! file_get_contents(public_path('css/app.css')) !!}
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="glass-navbar">
        <div class="nav-container">
            <!-- Logo -->
            <div class="nav-logo">
                <a href="{{ route('todos.index') }}" class="logo-link">
                    <div class="logo-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">Pro-ToDo</span>
                        <span class="logo-sub">Professional</span>
                    </div>
                </a>
            </div>

            <!-- Search Bar (Desktop) -->
            <div class="nav-search-desktop">
                <form action="{{ route('todos.index') }}" method="GET" class="search-form">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="search" 
                               name="search" 
                               class="search-input" 
                               placeholder="Search todos..." 
                               value="{{ request('search') }}"
                               aria-label="Search todos">
                        @if(request('search'))
                        <button type="button" class="search-clear" onclick="clearSearch()" aria-label="Clear search">
                            <i class="fas fa-times"></i>
                        </button>
                        @endif
                    </div>
                    <button type="submit" class="search-submit" aria-label="Submit search">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>

            <!-- User Actions -->
            <div class="nav-actions">
                <!-- Search Toggle (Mobile) -->
                <button class="nav-action-btn search-toggle" onclick="toggleMobileSearch()" aria-label="Toggle search">
                    <i class="fas fa-search"></i>
                </button>

                <!-- Profile Dropdown -->
                <div class="profile-dropdown">
                    <button class="nav-action-btn profile-toggle" onclick="toggleProfileDropdown()" aria-label="User profile">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="user-name-truncated">{{ strtok(Auth::user()->name, ' ') }}</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </button>
                    
                    <div class="dropdown-menu" id="profileDropdown">
                        <div class="dropdown-header">
                            <div class="user-info">
                                <div class="user-avatar-large">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="user-fullname">{{ Auth::user()->name }}</h4>
                                    <p class="user-email">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user-cog"></i>
                            <span>Edit Profile</span>
                        </a>
                        
                        <a href="{{ route('todos.trash') }}" class="dropdown-item">
                            <i class="fas fa-trash-restore"></i>
                            <span>Trashed Todos</span>
                        </a>
                        
                        <a href="#" class="dropdown-item" onclick="toggleDarkMode()">
                            <i class="fas fa-moon"></i>
                            <span>Dark Mode</span>
                            <div class="toggle-switch">
                                <div class="toggle-slider"></div>
                            </div>
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <form action="{{ route('logout') }}" method="POST" class="dropdown-logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="nav-action-btn mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Search -->
            <div class="nav-search-mobile" id="mobileSearch">
                <form action="{{ route('todos.index') }}" method="GET" class="search-form mobile">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="search" 
                               name="search" 
                               class="search-input" 
                               placeholder="Search todos..." 
                               value="{{ request('search') }}"
                               aria-label="Search todos">
                        @if(request('search'))
                        <button type="button" class="search-clear" onclick="clearSearch()" aria-label="Clear search">
                            <i class="fas fa-times"></i>
                        </button>
                        @endif
                        <button type="submit" class="search-submit" aria-label="Submit search">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-header">
                <h3>Menu</h3>
                <button class="mobile-menu-close" onclick="toggleMobileMenu()" aria-label="Close menu">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="mobile-menu-content">
                <a href="{{ route('todos.index') }}" class="mobile-menu-item">
                    <i class="fas fa-list-check"></i>
                    <span>All Todos</span>
                </a>
                
                <a href="{{ route('todos.create') }}" class="mobile-menu-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>New Todo</span>
                </a>
                
                <a href="{{ route('profile.edit') }}" class="mobile-menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span>Edit Profile</span>
                </a>
                
                <a href="{{ route('todos.trash') }}" class="mobile-menu-item">
                    <i class="fas fa-trash-restore"></i>
                    <span>Trashed Todos</span>
                </a>
                
                <div class="mobile-menu-divider"></div>
                
                <form action="{{ route('logout') }}" method="POST" class="mobile-logout-form">
                    @csrf
                    <button type="submit" class="mobile-menu-item logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Quick Actions Bar -->
    @hasSection('content')
        @if(!request()->routeIs('todos.create') && !request()->routeIs('todos.edit') && !request()->routeIs('todos.show'))
            @yield('quick-actions')
        @endif
    @endif

    <!-- Scripts -->
    <script>
        // Navigation functionality
        function toggleMobileSearch() {
            const mobileSearch = document.getElementById('mobileSearch');
            mobileSearch.classList.toggle('active');
        }

        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('show');
            
            // Close other dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(item => {
                if (item !== dropdown) item.classList.remove('show');
            });
        }

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        }

        function clearSearch() {
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.value = '';
                searchInput.closest('form').submit();
            }
        }

        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark-mode'));
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.profile-dropdown')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(item => {
                    item.classList.remove('show');
                });
            }
            
            if (!e.target.closest('.mobile-menu-toggle') && !e.target.closest('.mobile-menu')) {
                document.getElementById('mobileMenu').classList.remove('active');
                document.body.classList.remove('no-scroll');
            }
        });

        // Initialize dark mode
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark-mode');
            }
            
            // Close mobile menu on escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    document.getElementById('mobileMenu').classList.remove('active');
                    document.body.classList.remove('no-scroll');
                    document.querySelectorAll('.dropdown-menu.show').forEach(item => {
                        item.classList.remove('show');
                    });
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>