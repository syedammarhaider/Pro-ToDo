<?php

namespace App\Actions;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateTodoAction
{
    /**
     * Create a new todo item.
     *
     * @param array $data
     * @return Todo
     * @throws ValidationException
     */
    public function execute(array $data): Todo
    {
        $validated = Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
            'category' => 'nullable|string|max:100',
            'due_date' => 'nullable|date',
        ])->validate();

        return Todo::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'] ?? 'medium',
            'category' => $validated['category'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
        ]);
    }
}
