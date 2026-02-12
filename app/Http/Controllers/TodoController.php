<?php



namespace App\Http\Controllers;



use App\Models\Todo;

use App\Services\TodoService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;



class TodoController extends Controller

{

    public function __construct(private TodoService $todoService) {}



    // Display todos

    public function index(Request $request)

    {

        $filters = $request->only(['search', 'status', 'priority', 'category']);

        $sort = $request->only(['sort', 'direction']);

        $lastId = $request->integer('last_id');



        // Ultra-fast keyset pagination

        $todos = $this->todoService->getTodos($filters, $sort, $lastId);

        $categories = Todo::where('user_id', Auth::id())->distinct()->pluck('category')->filter();

        // Get accurate statistics

        $stats = $this->todoService->getStatistics();



        // Return JSON for AJAX requests (real-time updates)

        if ($request->expectsJson()) {

            return response()->json([

                'stats' => [

                    'total' => $stats['total'],

                    'done' => $stats['total'] > 0 ? round(($stats['completed'] / $stats['total']) * 100) : 0,

                    'completed' => $stats['completed'],

                    'pending' => $stats['active'],

                    'high_priority' => $stats['high_priority'],

                    'categories' => $stats['by_category']->count(),

                ]

            ]);

        }



        return view('todos.index', [

            'todos' => $todos,

            'categories' => $categories,

            'stats' => $stats,

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

        $validatedData['user_id'] = Auth::id();

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

        $this->todoService->deleteTodo($todo);



        return request()->expectsJson()

            ? response()->json(['success' => true, 'message' => 'Todo moved to trash.'])

            : back()->with('success', 'Todo moved to trash.');

    }



    // Trash page - REMOVED
    // public function trash()
    // {
    //     // Gate::authorize('delete todos');
    //     $trashedTodos = Todo::onlyTrashed()->where('user_id', Auth::id())->paginate(15);
    //     return view('todos.trash', compact('trashedTodos'));
    // }

    // Restore trashed todo - REMOVED
    // public function restore($id)
    // {
    //     // Gate::authorize('delete todos');
    //     $todo = Todo::withTrashed()->where('user_id', Auth::id())->findOrFail($id);
    //     $todo->restore();
    //     return back()->with('success', 'Todo restored.');
    // }

    // Permanently delete - REMOVED
    // public function forceDelete($id)
    // {
    //     // Gate::authorize('delete todos');
    //     $todo = Todo::withTrashed()->where('user_id', Auth::id())->findOrFail($id);
    //     $todo->forceDelete();
    //     return back()->with('success', 'Todo permanently deleted.');
    // }



    // Mark as complete

    public function complete(Todo $todo)

    {

        $this->todoService->completeTodo($todo);



        return request()->expectsJson()

            ? response()->json(['success' => true, 'message' => 'Todo marked as completed.'])

            : redirect()->back()->with('success', 'Todo marked as completed.');

    }



    // Mark as incomplete

    public function incomplete(Todo $todo)

    {

        $todo->update(['completed' => false]);

        // Clear caches after incomplete action

        $this->todoService->clearTodoCaches();



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



        return response()->json(['success' => true]);

    }



    // Bulk delete todos

    public function bulkDelete(Request $request)

    {

        Todo::whereIn('id', $request->ids)->delete();

        // Clear caches after bulk delete

        $this->todoService->clearTodoCaches();



        return back()->with('success', 'Todos deleted.');

    }



    // Bulk mark complete

    public function bulkComplete(Request $request)

    {

        $this->todoService->bulkComplete($request->ids);



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

