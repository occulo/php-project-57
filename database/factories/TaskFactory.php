<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(3),
            'status_id' => TaskStatus::query()->inRandomOrder()->value('id'),
            'assigned_to_id' => fake()->boolean(25)
                ? User::query()->inRandomOrder()->value('id')
                : null,
            'created_by_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
