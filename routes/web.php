<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);

Route::post('/task', [TaskController::class, 'store']);

Route::delete('/task/{id}', [TaskController::class, 'destroy']);

Route::get('/task/{id}/edit', [TaskController::class, 'edit']);

Route::put('/task/{id}', [TaskController::class, 'update']);

Route::get('/task/{id}/complete', [TaskController::class, 'markComplete']);