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
        $taskStatuses = TaskStatus::paginate(10);
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
            'name' => ['required', 'max:255', Rule::unique('task_statuses', 'name')],
        ], [
            'name.unique' => __('app.flash.task_statuses.name'),
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($validatedData)->save();

        flash(__('app.flash.task_statuses.created'));
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
            'name' => ['required', 'max:255', Rule::unique('task_statuses', 'name')->ignore($taskStatus->id)],
        ], [
            'name.unique' => __('app.flash.task_statuses.name'),
        ]);

        $taskStatus->fill($validatedData)->save();

        flash(__('app.flash.task_statuses.updated'));
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('app.flash.task_statuses.delete_failed'));
        } else {
            $taskStatus->delete();
            flash(__('app.flash.task_statuses.deleted'));
        }

        return redirect()->route('task_statuses.index');
    }
}
