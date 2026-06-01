<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private TaskStatus $status;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
        $this->task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);
    }

    public function testIndexPageExists(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testShowPageExists(): void
    {
        $response = $this->get(route('tasks.show', $this->task));
        $response->assertOk();
    }

    public function testGuestCannotAccessCreatePage(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotCreateTask(): void
    {
        $response = $this->post(route('tasks.store'), ['name' => 'Test']);
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotEditTask(): void
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotDestroyTask(): void
    {
        $response = $this->delete(route('tasks.destroy', $this->task));
        $response->assertRedirect(route('login'));
    }

    public function testUserCanAccessCreatePage(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testUserCanCreateTask(): void
    {
        $this->actingAs($this->user)->post(route('tasks.store'), [
            'name' => 'Test',
            'status_id' => $this->status->id,
        ])->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test',
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);
    }

    public function testUserCanEditTask(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task));
        $response->assertOk();
    }

    public function testUserCanUpdateTask(): void
    {
        $this->actingAs($this->user)->patch(route('tasks.update', $this->task), [
            'name' => 'Updated',
            'status_id' => $this->status->id
        ]);
        $this->assertDatabaseHas('tasks', [
            'id' => $this->task->id,
            'name' => 'Updated',
        ]);
    }

    public function testUserCanDestroyTask(): void
    {
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task));
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
    }

    public function testNonCreatorCannotDestroyTask(): void
    {
        $diffUser = User::factory()->create();
        $response = $this->actingAs($diffUser)->delete(route('tasks.destroy', $this->task));
        $response->assertForbidden();
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
    }
}
