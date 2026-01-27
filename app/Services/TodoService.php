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
        // Ultra-fast caching with smart invalidation - increased cache time for better performance
        $cacheKey = 'todos_' . md5(serialize($filters) . serialize($sort) . request('page', 1));

        return Cache::remember($cacheKey, 300, function () use ($filters, $sort) {
            $query = Todo::query()->select([
                'id', 'title', 'description', 'priority', 'completed',
                'due_date', 'category', 'position', 'created_at', 'updated_at'
            ]);

            // Apply filters
            $this->applyFilters($query, $filters);

            // Apply sorting
            $this->applySorting($query, $sort);

            return $query->paginate(50)->withQueryString();
        });
    }

    public function createTodo(array $data): Todo
    {
        $todo = $this->createTodoAction->execute($data);

        // Clear all todo caches and statistics when creating new todo
        $this->clearTodoCaches();

        return $todo;
    }

    public function updateTodo(Todo $todo, array $data): Todo
    {
        $updatedTodo = $this->updateTodoAction->execute($todo, $data);

        // Clear all todo caches and statistics when updating todo
        $this->clearTodoCaches();

        return $updatedTodo;
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
            $query->where('title', 'LIKE', '%' . $filters['search'] . '%');
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

    private function clearTodoCaches(): void
    {
        // Clear statistics cache
        Cache::forget('todo_stats');

        // For database/file cache, we can't easily clear by pattern
        // so we'll clear a few common cache keys that might exist
        $commonKeys = [
            'todos_' . md5(serialize([]) . serialize(['sort' => 'position', 'direction' => 'asc']) . '1'),
            'todos_' . md5(serialize(['status' => 'active']) . serialize(['sort' => 'position', 'direction' => 'asc']) . '1'),
            'todos_' . md5(serialize(['status' => 'completed']) . serialize(['sort' => 'position', 'direction' => 'asc']) . '1'),
        ];

        foreach ($commonKeys as $key) {
            Cache::forget($key);
        }
    }
}
