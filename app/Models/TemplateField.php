<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemplateField extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'field_name',
        'field_type',
        'is_required',
        'display_order',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    /**
     * Get the template that owns the field.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Get the values for this field.
     */
    public function values(): HasMany
    {
        return $this->hasMany(RecordValue::class);
    }
}
