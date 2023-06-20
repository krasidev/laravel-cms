<?php

use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ProjectController as BackendProjectController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\ProjectController as FrontendProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth forms
Auth::routes([
    'reset' => false
]);

// Backend
Route::group([
    'prefix' => 'admin',
    'as' => 'backend.',
    'middleware' => ['auth']
], function() {
    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // User is admin
    Route::middleware('can:manage_system')->group(function() {
        // Projects
        Route::resource('projects', BackendProjectController::class)->except('show');
        Route::patch('projects/{project}/restore', [BackendProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('projects/{project}/force-delete', [BackendProjectController::class, 'forceDelete'])->name('projects.force-delete');
        Route::post('projects/reorder', [BackendProjectController::class, 'reorder'])->name('projects.reorder');

        // Users
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');
    });
});

// Frontend
Route::name('frontend.')->group(function() {
    // Projects
    Route::get('/', [FrontendProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [FrontendProjectController::class, 'show'])->name('projects.show');
});
