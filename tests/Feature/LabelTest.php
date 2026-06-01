<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\Label;
use App\Models\User;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Label $label;
    private TaskStatus $status;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
        $this->label = Label::factory()->create();
        $this->task = Task::factory()->create([
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
        ]);
        $this->task->labels()->attach($this->label->id);
    }

    public function testIndexPageExists(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testGuestCannotAccessCreatePage(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotCreateLabel(): void
    {
        $response = $this->post(route('labels.store'), ['name' => 'Test']);
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotEditLabel(): void
    {
        $response = $this->get(route('labels.edit', $this->label));
        $response->assertRedirect(route('login'));
    }

    public function testGuestCannotDestroyLabel(): void
    {
        $response = $this->delete(route('labels.destroy', $this->label));
        $response->assertRedirect(route('login'));
    }

    public function testUserCanAccessCreatePage(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testUserCanCreateLabel(): void
    {
        $this->actingAs($this->user)->post(route('labels.store'), [
            'name' => 'Test',
        ])->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'Test']);
    }

    public function testUserCanEditLabel(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUserCanUpdateLabel(): void
    {
        $this->actingAs($this->user)->patch(route('labels.update', $this->label), ['name' => 'Updated']);
        $this->assertDatabaseHas('labels', ['name' => 'Updated']);
    }

    public function testUserCanDestroyLabel(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }

    public function testCannotDestroyLabelOfActiveTask(): void
    {
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $this->label));
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
    }
}
