<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg mb-4">

    <div class="container">

        <!-- Logo/Brand Name - Logo ya brand ka naam -->

        <a class="navbar-brand" href="{{ route('todos.index') }}">

            <i class="fas fa-tasks me-2"></i>

            <strong>PRO TODO</strong>

        </a>



        <!-- Mobile Toggle Button - Mobile ke liye toggle button -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>



        <!-- Navigation Links - Navigation links -->

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a class="nav-link" href="#stats" data-bs-toggle="collapse">

                        <i class="fas fa-chart-bar me-1"></i> Statistics

                    </a>

                </li>

            </ul>



            <!-- Search Form - Search ka form -->

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



            <!-- User Authentication Links -->

            @auth

                <div class="dropdown">

                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}

                    </button>

                    <ul class="dropdown-menu" aria-labelledby="userDropdown">

                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-1"></i>Profile</a></li>

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



<!-- Statistics Section (Collapsible) - Statistics section (collapsible) -->

<div class="collapse container mb-4" id="stats">

    <div class="card glass-effect">

        <div class="card-body">

            <div class="row text-center">

                <div class="col-md-3 mb-3">

                    <div class="p-3 bg-primary bg-opacity-10 rounded">

                        <h3 class="text-primary">{{ App\Models\Todo::count() }}</h3>

                        <small class="text-white">Total Todos</small>

                    </div>

                </div>

                <div class="col-md-3 mb-3">

                    <div class="p-3 bg-success bg-opacity-10 rounded">

                        <h3 class="text-success">{{ App\Models\Todo::completed()->count() }}</h3>

                        <small class="text-white">Completed</small>

                    </div>

                </div>

                <div class="col-md-3 mb-3">

                    <div class="p-3 bg-warning bg-opacity-10 rounded">

                        <h3 class="text-warning">{{ App\Models\Todo::active()->count() }}</h3>

                        <small class="text-white">Active</small>

                    </div>

                </div>

                <div class="col-md-3 mb-3">

                    <div class="p-3 bg-danger bg-opacity-10 rounded">

                        <h3 class="text-danger">{{ App\Models\Todo::overdue()->count() }}</h3>

                        <small class="text-white">Overdue</small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>