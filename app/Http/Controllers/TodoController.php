<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTodoCompletion;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    public function __construct(private TodoService $todoService) {}

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'priority', 'category']);
        $sort = $request->only(['sort', 'direction']);

        $todos = $this->todoService->getTodos($filters, $sort);
        $categories = Todo::distinct()->pluck('category')->filter();

        return view('todos.index', [
            'todos' => $todos,
            'categories' => $categories,
        ]);
    }

/////////////////////////////////////////////////////////////////////////////////
    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateTodo($request);
        $this->todoService->createTodo($validatedData);

        return redirect()->route('todos.index')
            ->with('success', 'Todo created successfully.');
    }

/////////////////////////////////////////////////////////////////////////////////

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }
/////////////////////////////////////////////////////////////////////////////////

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }
/////////////////////////////////////////////////////////////////////////////////

    public function update(Request $request, Todo $todo)
    {
        $validatedData = $this->validateTodo($request, true);
        $this->todoService->updateTodo($todo, $validatedData);

        return redirect()->route('todos.index')
            ->with('success', 'Todo updated successfully.');
    }
/////////////////////////////////////////////////////////////////////////////////

   public function destroy(Todo $todo)
{
    $this->todoService->deleteTodo($todo);

    // Check if request is AJAX
    if (request()->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Todo deleted successfully.'
        ]);
    }

    return back()->with('success', 'Todo moved to trash.');
}
/////////////////////////////////////////////////////////////////////////////////

    public function trash()
    {
        Gate::authorize('delete todos');
        $trashedTodos = Todo::onlyTrashed()->paginate(15);

        return view('todos.trash', compact('trashedTodos'));
    }
/////////////////////////////////////////////////////////////////////////////////

    public function restore($id)
    {
        Gate::authorize('delete todos');
        Todo::withTrashed()->findOrFail($id)->restore();

        return back()->with('success', 'Todo restored.');
    }
/////////////////////////////////////////////////////////////////////////////////

    public function forceDelete($id)
    {
        Gate::authorize('delete todos');
        Todo::withTrashed()->findOrFail($id)->forceDelete();

        return back()->with('success', 'Todo permanently deleted.');
    }
/////////////////////////////////////////////////////////////////////////////////

 public function complete(Todo $todo)
{
    $this->todoService->completeTodo($todo);
    
    // Check if request is AJAX
    if (request()->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Todo marked as completed.'
        ]);
    }
    
    return redirect()->route('todos.index')->with('success', 'Todo marked as completed.');
}
/////////////////////////////////////////////////////////////////////////////////


    public function incomplete(Todo $todo)
{
    $todo->update(['completed' => false]);

    // Check if request is AJAX
    if (request()->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Todo marked as incomplete.'
        ]);
    }

    return redirect()->back()->with('success', 'Todo marked as incomplete!');
}
/////////////////////////////////////////////////////////////////////////////////

    public function updatePositions(Request $request)
    {
        foreach ($request->positions as $position => $id) {
            Todo::whereId($id)->update(['position' => $position]);
        }

        return response()->json(['success' => true]);
    }
/////////////////////////////////////////////////////////////////////////////////

    public function bulkDelete(Request $request)
    {
        Todo::whereIn('id', $request->ids)->delete();

        // Clear all caches when bulk deleting todos
        $cacheKeys = \Illuminate\Support\Facades\Cache::get('todo_cache_keys', []);
        foreach ($cacheKeys as $key) {
            \Illuminate\Support\Facades\Cache::forget($key);
        }
        \Illuminate\Support\Facades\Cache::forget('todo_cache_keys');
        \Illuminate\Support\Facades\Cache::forget('todo_stats');

        return back()->with('success', 'Todos deleted.');
    }
/////////////////////////////////////////////////////////////////////////////////

    public function bulkComplete(Request $request)
    {
        Todo::whereIn('id', $request->ids)->update(['completed' => true]);

        return back()->with('success', 'Todos completed.');
    }
/////////////////////////////////////////////////////////////////////////////////

    /**
     * Cached statistics (performance optimized)
     */
    public function statistics()
    {
        Gate::authorize('view todos');
        $stats = $this->todoService->getStatistics();

        return view('todos.partials.stats', compact('stats'));
    }

    /**
     * Shared validation logic
     */
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

        $data = $request->validate($rules);

        return $data;
    }
}
