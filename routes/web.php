<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('tasks.index')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{task}/complete',[TaskController::class,'complete'])->name('tasks.complete');
    Route::resource('tags', TagController::class)->only(['index','store','destroy']);
    Route::post('tasks/{task}/attachments',[AttachmentController::class,'store'])->name('attachments.store');
    Route::delete('attachments/{attachment}',[AttachmentController::class,'destroy'])->name('attachments.destroy');
    Route::post('tasks/{task}/comments',[CommentController::class,'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
