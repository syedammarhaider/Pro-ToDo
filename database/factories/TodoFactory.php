<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Work', 'Personal', 'Shopping', 'Health', 'Education', 
            'Finance', 'Travel', 'Home', 'Projects', 'Entertainment',
            'Family', 'Business', 'Study', 'Fitness', 'Social'
        ];
        
        $allTags = [
            'urgent', 'important', 'meeting', 'deadline', 'review',
            'follow-up', 'call', 'email', 'research', 'planning',
            'development', 'design', 'testing', 'bug', 'feature',
            'documentation', 'presentation', 'report', 'analysis',
            'budget', 'invoice', 'contract', 'proposal', 'client',
            'team', 'management', 'strategy', 'goal', 'milestone'
        ];
        
        // Randomly select 0-3 tags for each todo
        $selectedTags = $this->faker->randomElements($allTags, $this->faker->numberBetween(0, 3));
        
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'completed' => $this->faker->boolean(30), // 30% completed
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'category' => $this->faker->randomElement($categories),
            'due_date' => $this->faker->optional(0.7)->dateTimeBetween('now', '+30 days'),
            'tags' => $selectedTags,
        ];
    }
}
