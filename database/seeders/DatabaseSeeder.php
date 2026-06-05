<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Label;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(5)->create();

        $this->call(TaskStatusSeeder::class);
        $this->call(LabelSeeder::class);

        Task::factory(10)->create()->each(fn($task) => $task->labels()->attach(Label::query()->inRandomOrder()->take(rand(1,2))->pluck('id')));
    }
}
