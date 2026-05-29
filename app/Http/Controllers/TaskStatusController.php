<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:task_statuses', 'max:255'],
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($validatedData)->save();

        flash('Status created successfully');
        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', Rule::unique('task_statuses')->ignore($taskStatus->id)],
        ]);

        $taskStatus->fill($validatedData)->save();

        flash('Status updated successfully');
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks()->exists()) {
            flash('Cannot delete status: linked to existing tasks');
        } else {
            $taskStatus->delete();
            flash('Status deleted successfully');
        }

        return redirect()->route('task_statuses.index');
    }
}
