<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\Label;
use App\Models\User;

class TaskFilterTest extends TestCase
{
    use RefreshDatabase;

    private User $assignee;
    private User $creator;

    private TaskStatus $activeStatus;
    private TaskStatus $completedStatus;

    private Label $label;

    private Task $activeTask;
    private Task $completedTask;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assignee = User::factory()->create();
        $this->creator = User::factory()->create();

        $this->activeStatus = TaskStatus::factory()->create(['name' => 'active']);
        $this->completedStatus = TaskStatus::factory()->create(['name' => 'completed']);

        $this->label = Label::factory()->create();

        $this->activeTask = Task::factory()->create([
            'name' => 'Active Task',
            'status_id' => $this->activeStatus->id,
            'created_by_id' => $this->creator->id,
            'assigned_to_id' => $this->assignee->id,
        ]);

        $this->activeTask->labels()->attach($this->label->id);

        $this->completedTask = Task::factory()->create([
            'name' => 'Completed Task',
            'status_id' => $this->completedStatus->id,
            'created_by_id' => $this->creator->id,
        ]);
    }

    public function testIndexReturnsAllTasksWithoutFilter(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
        $response->assertSee(['Active Task', 'Completed Task']);
    }

    public function testFilterByAssignee(): void
    {
        $response = $this->get(route('tasks.index', [
            'filter' => ['assigned_to_id' => $this->assignee->id],
        ]));
        $response->assertSee('Active Task');
        $response->assertDontSee('Completed Task');
    }

    public function testFilterByCreator(): void
    {
        $response = $this->get(route('tasks.index', [
            'filter' => ['created_by_id' => $this->creator->id],
        ]));
        $response->assertSee(['Active Task', 'Completed Task']);
    }

    public function testFilterByStatus(): void
    {
        $response = $this->get(route('tasks.index', [
            'filter' => ['status_id' => $this->activeStatus->id],
        ]));
        $response->assertSee('Active Task');
        $response->assertDontSee('Completed Task');
    }

    public function testFilterByLabel(): void
    {
        $response = $this->get(route('tasks.index', [
            'filter' => ['label_ids' => [$this->label->id]],
        ]));
        $response->assertSee('Active Task');
        $response->assertDontSee('Completed Task');
    }
}
