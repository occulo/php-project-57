<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view('tasks.create', compact('taskStatuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', Rule::exists('task_statuses', 'id')],
            'assigned_to_id' => ['nullable', Rule::exists('users', 'id')],
        ]);
        $validatedData['created_by_id'] = Auth::id();

        $task = new Task();
        $task->fill($validatedData)->save();

        flash('Task created successfully');
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
        $users = User::all();

        return view('tasks.edit', compact('task', 'taskStatuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', Rule::exists('task_statuses', 'id')],
            'assigned_to_id' => ['nullable', Rule::exists('users', 'id')],
        ]);

        $task->fill($validatedData)->save();

        flash('Task updated successfully');
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (Auth::id() !== $task->created_by_id) {
            flash('Cannot delete task: user is not authorized to perform this action');
            abort(403);
        } else {
            $task->delete();
            flash('Task deleted successfully');
        }

        return redirect()->route('tasks.index');
    }
}
