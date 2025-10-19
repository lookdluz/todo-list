<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
Route::apiResource('projects', Api\ProjectController::class);
Route::apiResource('tasks', Api\TaskController::class);
Route::post('tasks/{task}/complete', [Api\TaskController::class,'complete']);
});

require __DIR__.'/auth.php';
