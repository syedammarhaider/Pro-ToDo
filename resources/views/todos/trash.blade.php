@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Trashed Todos</h1>
        <a href="{{ route('todos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            ← Back to Todos
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            @if($trashedTodos->count() > 0)
                <div class="mb-4">
                    <p class="text-gray-600">These todos have been soft deleted. You can restore them or permanently delete them.</p>
                </div>

                <ul class="divide-y divide-gray-200">
                    @foreach($trashedTodos as $todo)
                        <li class="py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">{{ $todo->title }}</h3>
                                        @if($todo->description)
                                            <p class="text-gray-600">{{ $todo->description }}</p>
                                        @endif
                                        <p class="text-sm text-gray-500">Deleted at: {{ $todo->deleted_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <form action="{{ route('todos.restore', $todo->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="text-green-600 hover:text-green-900">Restore</button>
                                    </form>
                                    <form action="{{ route('todos.force-delete', $todo->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to permanently delete this todo?')">Delete Forever</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No trashed todos found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
