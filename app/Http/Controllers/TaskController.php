<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\Label;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        $labels = Label::all();
        $users = User::all();

        $tasks = QueryBuilder::for(Task::class)
            ->with(['status', 'labels', 'assignedTo', 'createdBy'])
            ->allowedFilters(
                AllowedFilter::exact('status_id'),
                AllowedFilter::callback('assigned_to_id', function ($q, $v) {
                    if ($v === 'unassigned') {
                        return $q->whereNull('assigned_to_id');
                    }
                    $q->where('assigned_to_id', $v);
                }),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::scope('label_ids', 'labels')
            )
            ->paginate(10);

        return view('tasks.index', compact('tasks', 'taskStatuses', 'users', 'labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskStatuses = TaskStatus::all();
        $labels = Label::all();
        $users = User::all();

        return view('tasks.create', compact('taskStatuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('tasks')->where('created_by_id', Auth::id()),
            ],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['integer', 'exists:labels,id'],
        ]);

        $task = Auth::user()->createdTasks()->create($validatedData);
        $task->labels()->sync($request->labels ?? []);

        flash(__('app.flash.tasks.created'));
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all();
        $labels = Label::all();
        $users = User::all();

        return view('tasks.edit', compact('task', 'taskStatuses', 'labels', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('tasks')->where('created_by_id', $task->created_by_id)->ignore($task->id),
            ],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['integer', 'exists:labels,id'],
        ]);

        $task->fill($validatedData)->save();
        $task->labels()->sync($request->labels ?? []);

        flash(__('app.flash.tasks.updated'));
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('app.flash.tasks.deleted'));
        return redirect()->route('tasks.index');
    }
}
