<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function definition() {
        return [
            'title'=>fake()->sentence(4),
            'description'=>fake()->paragraph(),
            'status'=>fake()->randomElement(['todo','doing','done']),
            'priority'=>fake()->randomElement(['low','medium','high']),
            'due_date'=>fake()->optional()->dateTimeBetween('now','+1 month'),
        ];
    }
}