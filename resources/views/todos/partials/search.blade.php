<div class="mb-6">
    <form action="{{ route('todos.index') }}" method="GET" class="flex">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search todos..." class="flex-1 border-gray-300 rounded-l-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
            Search
        </button>
    </form>
</div>
