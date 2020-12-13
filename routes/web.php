<?php

use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

Route::get('/', function () {
    
    // Role::create(['name' => 'writer']);
    // Permission::create(['name' => 'edit articles']);
    // return 'Role created...';
    // $role = Role::create(['name' => 'writer']);
    // $permission = Permission::create(['name' => 'edit posts']);
    // auth()->user()->assignRole('user');
    // return auth()->user()->givePermissionTo('add posts');
    // return 'ok';
    // dump(auth()->user()->hasRole('user'));
    
    // foreach (Role::all() as $key => $role) {
    //     // echo $role->name;
    //     dump($role->except('guard_name')->toArray());
    // }
    // dd();
    
    // $user = auth()->user();
    // // dump('Текущий польз-ль - '.$user->name);
    // if (isset($user)) {
    // 
    //     if ($user->hasRole('admin')) {
    //         dump('Текущий польз-ль - '.$user->name.' и его роль admin');
    //     } elseif ($user->hasRole('user')) {
    //         dump('Текущий польз-ль - '.$user->name.' и его роль user');
    //     }
    // }
    // create permissions
    // Permission::create(['name' => 'edit articles']);
    // Permission::create(['name' => 'delete articles']);
    // Permission::create(['name' => 'publish articles']);
    // Permission::create(['name' => 'unpublish articles']);
    
    return view('welcome');
});



use App\Http\Controllers\ArticleController;
Route::get('main', [ArticleController::class, 'getArticles'])->name('main');
// Route::get('main', function () {
//     return view('main');
// });
Route::get('show-posts-author/{author}', [ArticleController::class, 'getArticlesOfAuthor'])->name('showPostsAuthor');

Route::middleware(['auth:sanctum', 'verified', 'addingRoleToUser'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::resource('permissions', App\Http\Controllers\PermissionController::class);

Route::resource('posts', App\Http\Controllers\PostController::class);
// Route::resource('posts', App\Http\Controllers\PostController::class)->middleware(['role:admin|user']);

Route::resource('categories', App\Http\Controllers\CategoryController::class);