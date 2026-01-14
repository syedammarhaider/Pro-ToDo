<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mass assignment ke liye fields
     * Fields that can be filled via mass assignment
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'completed',
        'due_date',
        'category',
        'tags',
        'position',
    ];

    /**
     * Data type casting
     * Data ko proper format me convert karna
     */
    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'date',
        'tags' => 'array',
        'position' => 'integer',
    ];

    /**
     * Default values for attributes
     * Default values jab koi value nahi di gayi
     */
    protected $attributes = [
        'priority' => 'medium',
        'completed' => false,
    ];

    /**
     * Scope for active todos
     * Active todos ke liye query scope
     */
    public function scopeActive($query)
    {
        return $query->where('completed', false);
    }

    /**
     * Scope for completed todos
     * Completed todos ke liye query scope
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Scope for priority filtering
     * Priority ke hisab se filter karna
     */
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope for category filtering
     * Category ke hisab se filter karna
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope for due date filtering
     * Due date ke hisab se filter karna
     */
    public function scopeDueToday($query)
    {
        return $query->whereDate('due_date', today());
    }

    /**
     * Scope for overdue todos
     * Overdue todos ke liye scope
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', today())
                     ->where('completed', false);
    }

    /**
     * Search scope for todos
     * Search functionality ke liye scope
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Check if todo is overdue
     * Todo overdue hai ya nahi check karna
     */
    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && !$this->completed;
    }

    /**
     * Get priority color for UI
     * UI me priority ke liye color dena
     */
    public function getPriorityColor(): string
    {
        return match($this->priority) {
            'high' => 'danger',
            'medium' => 'warning',
            'low' => 'success',
            default => 'secondary',
        };
    }

    /**
     * Get status text
     * Status ka text format me dena
     */
    public function getStatusText(): string
    {
        if ($this->completed) return 'Completed';
        if ($this->isOverdue()) return 'Overdue';
        return 'Pending';
    }
}