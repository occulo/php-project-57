<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate(10);
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:labels', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'name.unique' => __('app.flash.labels.name'),
        ]);

        $label = new Label();
        $label->fill($validatedData)->save();

        flash(__('app.flash.labels.created'));
        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('labels', 'name')->ignore($label->id)
            ],
            'description' => ['nullable', 'string'],
        ], [
            'name.unique' => __('app.flash.labels.name'),
        ]);

        $label->fill($validatedData)->save();

        flash(__('app.flash.labels.updated'));
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        try {
            $label->delete();
            flash(__('app.flash.labels.deleted'));
        } catch (\Exception $e) {
            flash(__('app.flash.labels.delete_failed'));
        }
        return redirect()->route('labels.index');
    }
}
