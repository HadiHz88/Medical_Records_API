<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'description' => 'json',
    ];

    /**
     * Get the fields for the template.
     */
    public function fields(): HasMany
    {
        return $this->hasMany(TemplateField::class);
    }

    /**
     * Get the records based on this template.
     */
    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }
}
