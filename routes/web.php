<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateFieldController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Records'));
Route::get('/templates', fn() => Inertia::render('Templates'));
Route::get('/records', fn() => Inertia::render('Records'));
Route::get('/records/new/{templateId}', fn() => Inertia::render('Records'));
Route::get('/login', fn() => Inertia::render('Login'));

Route::fallback(fn() => Inertia::render('NotFound'));
