<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs', [DocsController::class, 'ui'])->name('l5-swagger.default.docs');
Route::get('/docs.json', [DocsController::class, 'json'])->name('l5-swagger.default.docs.json');
Route::get('/swagger-check', [DocsController::class, 'check']);
