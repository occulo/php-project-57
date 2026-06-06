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
    private User $diffUser;

    private TaskStatus $status;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->diffUser = User::factory()->create();

        $this->status = TaskStatus::factory()->create();
    }

    public function testIndexPageExists(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testShowPageExists(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->get(route('tasks.show', $task));
        $response->assertOk();
    }

    public function testGuestCannotAccessCreatePage(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertForbidden();
    }

    public function testGuestCannotCreateTask(): void
    {
        $response = $this->post(route('tasks.store'), ['name' => 'Test']);
        $response->assertForbidden();
    }

    public function testGuestCannotAccessEditPage(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->get(route('tasks.edit', $task));
        $response->assertForbidden();
    }

    public function testGuestCannotDestroyTask(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->delete(route('tasks.destroy', $task));
        $response->assertForbidden();
    }

    public function testUserCanAccessCreatePage(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testUserCanCreateTask(): void
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), [
            'name' => 'Test',
            'status_id' => $this->status->id,
        ]);
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test',
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);
    }

    public function testCreatorCanAccessEditPage(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)->get(route('tasks.edit', $task));
        $response->assertOk();
    }

    public function testCreatorCanUpdateTask(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), [
            'name' => 'Updated',
            'status_id' => $task->status->id,
        ]);
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Updated',
        ]);
    }

    public function testCreatorCanDestroyTask(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $task));
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testNonCreatorCannotAccessEditPage(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->diffUser)->get(route('tasks.edit', $task));
        $response->assertForbidden();
    }

    public function testNonCreatorCannotUpdateTask(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->diffUser)->patch(route('tasks.update', $task), [
            'name' => 'Updated',
            'status_id' => $task->status->id,
        ]);
        $response->assertForbidden();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'name' => 'Updated',
        ]);
    }

    public function testNonCreatorCannotDestroyTask(): void
    {
        $task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->diffUser)->delete(route('tasks.destroy', $task));
        $response->assertForbidden();

        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }
}
