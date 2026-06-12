<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SummaryController;

/*
|--------------------------------------------------------------------------
| Notes CRUD Routes
|--------------------------------------------------------------------------
*/

Route::get('/notes', [NoteController::class, 'index']);

Route::post('/notes', [NoteController::class, 'store']);

Route::get('/notes/{id}', [NoteController::class, 'show']);

Route::put('/notes/{id}', [NoteController::class, 'update']);

Route::delete('/notes/{id}', [NoteController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| AI Semantic Search
|--------------------------------------------------------------------------
*/

Route::get('/notes/search/semantic', [SearchController::class, 'search']);

/*
|--------------------------------------------------------------------------
| AI Summary
|--------------------------------------------------------------------------
*/

Route::post('/notes/{id}/summary', [SummaryController::class, 'generate']);