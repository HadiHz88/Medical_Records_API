<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateFieldController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app'); // Make sure the Blade view file is named app.blade.php
})->where('any', '.*');


// Template routes
Route::resource('templates', TemplateController::class);

// Template field routes
Route::get('templates/{template}/fields/create', [TemplateFieldController::class, 'create'])->name('templates.fields.create');
Route::post('templates/{template}/fields', [TemplateFieldController::class, 'store'])->name('templates.fields.store');
Route::get('templates/{template}/fields/{field}/edit', [TemplateFieldController::class, 'edit'])->name('templates.fields.edit');
Route::put('templates/{template}/fields/{field}', [TemplateFieldController::class, 'update'])->name('templates.fields.update');
Route::delete('templates/{template}/fields/{field}', [TemplateFieldController::class, 'destroy'])->name('templates.fields.destroy');

// Record routes
Route::get('records', [RecordController::class, 'index'])->name('records.index');
Route::get('records/select-template', [RecordController::class, 'selectTemplate'])->name('records.select-template');
Route::get('records/create/{template}', [RecordController::class, 'create'])->name('records.create');
Route::post('records/{template}', [RecordController::class, 'store'])->name('records.store');
Route::get('records/{record}', [RecordController::class, 'show'])->name('records.show');
Route::get('records/{record}/edit', [RecordController::class, 'edit'])->name('records.edit');
Route::put('records/{record}', [RecordController::class, 'update'])->name('records.update');
Route::delete('records/{record}', [RecordController::class, 'destroy'])->name('records.destroy');
