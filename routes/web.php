<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AiTestController;
use App\Http\Controllers\DashboardController;




use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
Route::resource('projects', ProjectController::class)->except(['show']);

    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');

    Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])
    ->name('projects.restore');

    Route::patch('/tasks/{id}/restore', [TaskController::class, 'restore'])
        ->name('tasks.restore');

    Route::get('/projects/trashed', [ProjectController::class, 'trashed'])
    ->name('projects.trashed');

    Route::get('/tasks/trashed', [TaskController::class, 'trashed'])
    ->name('tasks.trashed');




});

Route::get('/ai-test', [AiTestController::class, 'test']);

Route::post('/projects/{project}/ai-tasks',
    [ProjectController::class, 'generateAiTasks']
)->name('projects.ai.tasks');


Route::post('/tasks/{task}/improve',
    [TaskController::class, 'improve']
)->name('tasks.improve');
require __DIR__.'/auth.php';
