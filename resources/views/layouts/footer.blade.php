<footer class="mt-5 py-4 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="fas fa-tasks me-2"></i> PRO TODO</h5>
                <p class="text-light">Professional Todo Management Application. Stay organized and productive.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('todos.index') }}" class="text-light text-decoration-none">All Todos</a></li>
                    <li><a href="{{ route('todos.create') }}" class="text-light text-decoration-none">Create New</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Completed</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Overdue</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Features</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success me-2"></i> Priority Levels</li>
                    <li><i class="fas fa-check text-success me-2"></i> Categories & Tags</li>
                    <li><i class="fas fa-check text-success me-2"></i> Due Dates</li>
                    <li><i class="fas fa-check text-success me-2"></i> Drag & Drop</li>
                </ul>
            </div>
        </div>
        <hr class="bg-light">
        <div class="text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Professional Todo App. All rights reserved.</p>
            <small class="text-light">Made with <i class="fas fa-heart text-danger"></i> for productivity</small>
        </div>
    </div>
</footer>