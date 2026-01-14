<?php

namespace App\Services;

use App\Actions\CreateTodoAction;
use App\Actions\UpdateTodoAction;
use App\Jobs\ProcessTodoCompletion;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class TodoService
{
    public function __construct(
        private CreateTodoAction $createTodoAction,
        private UpdateTodoAction $updateTodoAction
    ) {}

    public function getTodos(array $filters = [], array $sort = []): LengthAwarePaginator
    {
        $query = Todo::query();

        // Apply filters
        $this->applyFilters($query, $filters);

        // Apply sorting
        $this->applySorting($query, $sort);

        return $query->paginate(15)->withQueryString();
    }

    public function createTodo(array $data): Todo
    {
        return $this->createTodoAction->execute($data);
    }

    public function updateTodo(Todo $todo, array $data): Todo
    {
        return $this->updateTodoAction->execute($todo, $data);
    }

    public function deleteTodo(Todo $todo): void
    {
        $todo->delete();
        Cache::forget('todo_stats');
    }

    public function completeTodo(Todo $todo): void
    {
        $todo->update(['completed' => true]);
        Cache::forget('todo_stats');

        // Dispatch job for async processing
        ProcessTodoCompletion::dispatch($todo);
    }

    public function bulkComplete(array $ids): void
    {
        Todo::whereIn('id', $ids)->update(['completed' => true]);
        Cache::forget('todo_stats');
    }

    public function getStatistics(): array
    {
        return Cache::remember('todo_stats', 300, function () {
            return [
                'total' => Todo::count(),
                'completed' => Todo::completed()->count(),
                'active' => Todo::active()->count(),
                'overdue' => Todo::overdue()->count(),
                'high_priority' => Todo::priority('high')->count(),
                'by_category' => Todo::groupBy('category')
                    ->select('category', \DB::raw('count(*) as total'))
                    ->get(),
            ];
        });
    }

    private function applyFilters($query, array $filters): void
    {
        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }

        if (!empty($filters['status'])) {
            match ($filters['status']) {
                'active' => $query->active(),
                'completed' => $query->completed(),
                'overdue' => $query->overdue(),
                default => null,
            };
        }

        if (!empty($filters['priority'])) {
            $query->priority($filters['priority']);
        }

        if (!empty($filters['category'])) {
            $query->category($filters['category']);
        }
    }

    private function applySorting($query, array $sort): void
    {
        $allowedSorts = ['position', 'due_date', 'priority', 'created_at'];
        $sortBy = isset($sort['sort']) && in_array($sort['sort'], $allowedSorts) ? $sort['sort'] : 'position';
        $direction = isset($sort['direction']) && $sort['direction'] === 'desc' ? 'desc' : 'asc';

        $query->orderBy($sortBy, $direction);
    }
}
