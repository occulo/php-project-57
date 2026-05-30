<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
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
        $labels = Label::all();
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
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
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
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
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
        if ($label->tasks()->exists()) {
            flash(__('app.flash.labels.delete_failed'));
        } else {
            $label->delete();
            flash(__('app.flash.labels.deleted'));
        }

        return redirect()->route('labels.index');
    }
}
