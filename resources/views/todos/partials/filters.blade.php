<div class="mb-6">
    <div class="flex space-x-4 text-black">
        <a href="{{ route('todos.index') }}" class="px-4 py-2 {{ !request('filter') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-md">
            All
        </a>
        <a href="{{ route('todos.index', ['filter' => 'pending']) }}" class="px-4 py-2 {{ request('filter') === 'pending' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-md">
            Pending
        </a>
        <a href="{{ route('todos.index', ['filter' => 'completed']) }}" class="px-4 py-2 {{ request('filter') === 'completed' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-md">
            Completed
        </a>
    </div>
</div>
