<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    public function __construct(private TodoService $todoService) {}

    // Display todos
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'priority', 'category']);
        $sort = $request->only(['sort', 'direction']);

        // Always fetch fresh data
        $todos = $this->todoService->getTodos($filters, $sort);
        $categories = Todo::distinct()->pluck('category')->filter();

        return view('todos.index', [
            'todos' => $todos,
            'categories' => $categories,
        ]);
    }

    // Show create form
    public function create()
    {
        return view('todos.create');
    }

    // Store new todo
    public function store(Request $request)
    {
        $validatedData = $this->validateTodo($request);
        $this->todoService->createTodo($validatedData);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
    }

    // Show single todo
    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    // Show edit form
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    // Update todo
    public function update(Request $request, Todo $todo)
    {
        $validatedData = $this->validateTodo($request, true);
        $this->todoService->updateTodo($todo, $validatedData);

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully.');
    }

    // Soft delete todo
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return request()->expectsJson()
            ? response()->json(['success' => true, 'message' => 'Todo moved to trash.'])
            : back()->with('success', 'Todo moved to trash.');
    }

    // Trash page
    public function trash()
    {
        Gate::authorize('delete todos');
        $trashedTodos = Todo::onlyTrashed()->paginate(15);

        return view('todos.trash', compact('trashedTodos'));
    }

    // Restore trashed todo
    public function restore($id)
    {
        Gate::authorize('delete todos');
        Todo::withTrashed()->findOrFail($id)->restore();
        Cache::flush();

        return back()->with('success', 'Todo restored.');
    }

    // Permanently delete
    public function forceDelete($id)
    {
        Gate::authorize('delete todos');
        Todo::withTrashed()->findOrFail($id)->forceDelete();
        Cache::flush();

        return back()->with('success', 'Todo permanently deleted.');
    }

    // Mark as complete
    public function complete(Todo $todo)
    {
        $todo->update(['completed' => true]);
        Cache::flush();

        return request()->expectsJson()
            ? response()->json(['success' => true, 'message' => 'Todo marked as completed.'])
            : redirect()->back()->with('success', 'Todo marked as completed.');
    }

    // Mark as incomplete
    public function incomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);
        Cache::flush();

        return request()->expectsJson()
            ? response()->json(['success' => true, 'message' => 'Todo marked as incomplete.'])
            : redirect()->back()->with('success', 'Todo marked as incomplete.');
    }

    // Update positions (drag & drop)
    public function updatePositions(Request $request)
    {
        foreach ($request->positions as $position => $id) {
            Todo::whereId($id)->update(['position' => $position]);
        }
        Cache::flush();

        return response()->json(['success' => true]);
    }

    // Bulk delete todos
    public function bulkDelete(Request $request)
    {
        Todo::whereIn('id', $request->ids)->delete();
        Cache::flush();

        return back()->with('success', 'Todos deleted.');
    }

    // Bulk mark complete
    public function bulkComplete(Request $request)
    {
        Todo::whereIn('id', $request->ids)->update(['completed' => true]);
        Cache::flush();

        return back()->with('success', 'Todos completed.');
    }

    // Statistics (cached)
    public function statistics()
    {
        Gate::authorize('view todos');
        $stats = $this->todoService->getStatistics();

        return view('todos.partials.stats', compact('stats'));
    }

    // Shared validation logic
    private function validateTodo(Request $request, bool $update = false): array
    {
        $rules = [
            'title'       => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:low,medium,high',
            'due_date'    => $update ? 'nullable|date' : 'nullable|date|after:today',
            'category'    => 'nullable|string|max:50',
            'completed'   => 'sometimes|boolean',
        ];

        return $request->validate($rules);
    }
}
