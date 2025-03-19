<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    /**
     * Display a listing of records.
     */
    public function index()
    {
        $records = Record::with('template')->latest()->paginate(15);

//        return view('records.index', compact('records'));
    }

    /**
     * Show form to select a template for creating a new record.
     */
    public function selectTemplate()
    {
        $templates = Template::all();

//        return view('records.select_template', compact('templates'));
    }

    /**
     * Show the form for creating a new record based on template.
     */
    public function create(Template $template)
    {
        $fields = $template->fields()->orderBy('display_order')->get();

//        return view('records.create', compact('template', 'fields'));
    }

    /**
     * Store a newly created record.
     */
    public function store(Request $request, Template $template)
    {
        $fields = $template->fields;

        // Build validation rules based on field types
        $rules = [];
        foreach ($fields as $field) {
            $rule = [];

            if ($field->is_required) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }

            switch ($field->field_type) {
                case 'number':
                    $rule[] = 'numeric';
                    break;
                case 'email':
                    $rule[] = 'email';
                    break;
                case 'date':
                    $rule[] = 'date';
                    break;
                case 'file':
                    $rule[] = 'file';
                    break;
                default:
                    $rule[] = 'string';
                    break;
            }

            $rules['field_' . $field->id] = implode('|', $rule);
        }

        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            // Create the record
            $record = Record::create([
                'template_id' => $template->id,
            ]);

            // Save the field values
            foreach ($fields as $field) {
                $value = $request->input('field_' . $field->id);

                // Handle file uploads if needed
                if ($field->field_type === 'file' && $request->hasFile('field_' . $field->id)) {
                    $path = $request->file('field_' . $field->id)->store('uploads');
                    $value = $path;
                }

                $record->values()->create([
                    'template_field_id' => $field->id,
                    'value' => $value,
                ]);
            }

            DB::commit();

//            return redirect()->route('records.show', $record->id)->with('success', 'Record created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

//            return redirect()->back()->with('error', 'Failed to create record: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified record.
     */
    public function show(Record $record)
    {
        $record->load(['template', 'values.field']);

//        return view('records.show', compact('record'));
    }

    /**
     * Show the form for editing the specified record.
     */
    public function edit(Record $record)
    {
        $record->load(['template', 'values.field']);
        $template = $record->template;
        $fields = $template->fields()->orderBy('display_order')->get();

        // Get existing values as key-value pairs for easier form population
        $values = [];
        foreach ($record->values as $value) {
            $values[$value->field->id] = $value->value;
        }

//        return view('records.edit', compact('record', 'template', 'fields', 'values'));
    }

    /**
     * Update the specified record.
     */
    public function update(Request $request, Record $record)
    {
        $template = $record->template;
        $fields = $template->fields;

        // Build validation rules based on field types
        $rules = [];
        foreach ($fields as $field) {
            $rule = [];

            if ($field->is_required) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }

            switch ($field->field_type) {
                case 'number':
                    $rule[] = 'numeric';
                    break;
                case 'email':
                    $rule[] = 'email';
                    break;
                case 'date':
                    $rule[] = 'date';
                    break;
                case 'file':
                    $rule[] = 'file';
                    break;
                default:
                    $rule[] = 'string';
                    break;
            }

            $rules['field_' . $field->id] = implode('|', $rule);
        }

        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            // Update the field values
            foreach ($fields as $field) {
                $value = $request->input('field_' . $field->id);

                // Handle file uploads if needed
                if ($field->field_type === 'file' && $request->hasFile('field_' . $field->id)) {
                    $path = $request->file('field_' . $field->id)->store('uploads');
                    $value = $path;
                }

                // Find existing value or create new one
                $recordValue = $record->values()->firstOrNew([
                    'template_field_id' => $field->id,
                ]);

                $recordValue->value = $value;
                $recordValue->save();
            }

            DB::commit();

//            return redirect()->route('records.show', $record->id)->with('success', 'Record updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

//            return redirect()->back()->with('error', 'Failed to update record: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified record.
     */
    public function destroy(Record $record)
    {
        $record->delete();

//        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
