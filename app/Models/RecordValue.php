<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'template_field_id',
        'value',
    ];

    /**
     * Get the record that owns this value.
     */
    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class);
    }

    /**
     * Get the field this value corresponds to.
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(TemplateField::class, 'template_field_id');
    }
}
