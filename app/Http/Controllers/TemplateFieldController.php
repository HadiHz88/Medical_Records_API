<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\TemplateField;
use Illuminate\Http\Request;

class TemplateFieldController extends Controller
{
    /**
     * Show the form for creating new fields for a template.
     */
    public function create(Template $template)
    {
        $fieldTypes = [
            'text' => 'Text',
            'number' => 'Number',
            'date' => 'Date',
            'email' => 'Email',
            'textarea' => 'Long Text',
            'select' => 'Dropdown',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio',
            'file' => 'File Upload',
        ];

        return view('template_fields.create', compact('template', 'fieldTypes'));
    }

    /**
     * Store a newly created field.
     */
    public function store(Request $request, Template $template)
    {
        $validated = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_type' => 'required|string|max:50',
            'is_required' => 'sometimes|boolean',
            'display_order' => 'required|integer|min:1',
        ]);

        $field = $template->fields()->create([
            'field_name' => $validated['field_name'],
            'field_type' => $validated['field_type'],
            'is_required' => $request->has('is_required'),
            'display_order' => $validated['display_order'],
        ]);

        if ($request->has('add_another')) {
            return redirect()->back()->with('success', 'Field added successfully.');
        }

        return redirect()->route('templates.show', $template->id)
            ->with('success', 'Field added successfully.');
    }

    /**
     * Show the form for editing a field.
     */
    public function edit(Template $template, TemplateField $field)
    {
        $fieldTypes = [
            'text' => 'Text',
            'number' => 'Number',
            'date' => 'Date',
            'email' => 'Email',
            'textarea' => 'Long Text',
            'select' => 'Dropdown',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio',
            'file' => 'File Upload',
        ];

        return view('template_fields.edit', compact('template', 'field', 'fieldTypes'));
    }

    /**
     * Update the specified field.
     */
    public function update(Request $request, Template $template, TemplateField $field)
    {
        $validated = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_type' => 'required|string|max:50',
            'is_required' => 'sometimes|boolean',
            'display_order' => 'required|integer|min:1',
        ]);

        $field->update([
            'field_name' => $validated['field_name'],
            'field_type' => $validated['field_type'],
            'is_required' => $request->has('is_required'),
            'display_order' => $validated['display_order'],
        ]);

        return redirect()->route('templates.show', $template->id)
            ->with('success', 'Field updated successfully.');
    }

    /**
     * Remove the specified field.
     */
    public function destroy(Template $template, TemplateField $field)
    {
        $field->delete();

        return redirect()->route('templates.show', $template->id)
            ->with('success', 'Field deleted successfully.');
    }
}
