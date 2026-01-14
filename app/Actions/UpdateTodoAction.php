<?php

namespace App\Actions;

use App\Models\Todo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateTodoAction
{
    /**
     * Update an existing todo item.
     *
     * @param Todo $todo
     * @param array $data
     * @return Todo
     * @throws ValidationException
     */
    public function execute(Todo $todo, array $data): Todo
    {
        $validated = Validator::make($data, [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|in:low,medium,high',
            'category' => 'nullable|string|max:100',
            'due_date' => 'nullable|date',
            'completed' => 'sometimes|boolean',
        ])->validate();

        $todo->update($validated);
        
        return $todo->fresh();
    }
}
