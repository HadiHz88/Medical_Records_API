<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
    ];

    /**
     * Get the template for this record.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Get the values for this record.
     */
    public function values(): HasMany
    {
        return $this->hasMany(RecordValue::class);
    }

    /**
     * Get a specific field value by field ID.
     */
    public function getFieldValue($fieldId)
    {
        $value = $this->values()->whereHas('field', function ($query) use ($fieldId) {
            $query->where('id', $fieldId);
        })->first();

        return $value ? $value->value : null;
    }
}
