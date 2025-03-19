<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    /**
     * Display a listing of templates.
     */
    public function index()
    {
        $templates = Template::all();

//        return view('templates.index', compact('templates'));
    }

    /**
     * Store a newly created template.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:templates',
            'description' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $template = Template::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

//        return redirect()->route('templates.fields.create', $template->id)->with('success', 'Template created successfully. Now add fields to it.');
    }

    /**
     * Show the form for creating a new template.
     */
    public function create()
    {
//        return view('templates.create');
    }

    /**
     * Display the specified template.
     */
    public function show(Template $template)
    {
        $template->load('fields');

//        return view('templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified template.
     */
    public function edit(Template $template)
    {
//        return view('templates.edit', compact('template'));
    }

    /**
     * Update the specified template.
     */
    public function update(Request $request, Template $template)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:templates,name,' . $template->id,
            'description' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $template->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

//        return redirect()->route('templates.show', $template->id)->with('success', 'Template updated successfully.');
    }

    /**
     * Remove the specified template.
     */
    public function destroy(Template $template)
    {
        $template->delete();

//        return redirect()->route('templates.index')->with('success', 'Template deleted successfully.');
    }
}
