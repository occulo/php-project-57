<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusTest extends TestCase
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
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testGuestCannotCreateStatus(): void
    {
        $response = $this->post(route('task_statuses.store'), ['name' => 'Test']);
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotEditStatus(): void
    {
        $response = $this->get(route('task_statuses.edit', $this->status));
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotDestroyStatus(): void
    {
        $response = $this->delete(route('task_statuses.destroy', $this->status));
        $response->assertRedirect(route('login'));
    }

    public function testUserCanCreateStatus(): void
    {
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), ['name' => 'Test']);
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'Test']);
    }

    public function testUserCanEditStatus(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $this->status));
        $response->assertOk();
    }

    public function testUserCanUpdateStatus(): void
    {
        $this->actingAs($this->user)->patch(route('task_statuses.update', $this->status), ['name' => 'Updated']);
        $this->assertDatabaseHas('task_statuses', ['name' => 'Updated']);
    }

    public function testUserCanDestroyStatus(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $status));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }

    public function testCannotDestroyStatusOfActiveTask(): void
    {
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->status));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['id' => $this->status->id]);
    }
}
