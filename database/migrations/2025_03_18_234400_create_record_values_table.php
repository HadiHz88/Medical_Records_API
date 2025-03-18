<?php

use App\Models\Record;
use App\Models\TemplateField;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('record_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Record::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TemplateField::class)->constrained()->cascadeOnDelete();
            $table->text('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_values');
    }
};
