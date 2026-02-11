<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Todo Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $totalTodos }}</div>
                <div class="text-sm text-gray-600">Total Todos</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ $completedTodos }}</div>
                <div class="text-sm text-gray-600">Completed</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-red-600">{{ $pendingTodos }}</div>
                <div class="text-sm text-gray-600">Pending</div>
            </div>
        </div>
    </div>
</div>
