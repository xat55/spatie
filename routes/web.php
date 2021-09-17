<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Site\MainController;
use App\Http\Controllers\Site\SinglePostController;
use App\Http\Controllers\Site\AuthorPostsController;
use App\Http\Controllers\Site\CategoryPostsController;
use App\Http\Controllers\Site\SearchPostsController;
use App\Http\Controllers\Site\ActivityUsersController;


Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('show-post/{post_id}', [SinglePostController::class, 'index'])
    ->name('single_post');

Route::get('show-posts-author/{user_id}', [AuthorPostsController::class, 'index'])
    ->name('show_posts_author');

Route::get('show-posts-category/{category_id}', [CategoryPostsController::class, 'index'])
    ->name('show_posts_category');

Route::get('search', [SearchPostsController::class, 'index'])->name('search');

Route::get('block_user/{post_id}', [ActivityUsersController::class, 'blockUser'])->name('block_user');

// -----------------------------------------------------------------------------
// First route verify
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Second route verify
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed', 'addingRoleToUser:user'])->name('verification.verify');

// Third route verify
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// -----------------------------------------------------------------------------

Route::middleware(['auth', 'verified', 'addingRoleToUser:user', 'role:admin|user'])
    ->get('/dashboard', function () {

    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('posts', App\Http\Controllers\PostController::class)
        ->middleware(['role:admin|user']);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});

