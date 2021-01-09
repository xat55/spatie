<?php

use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Http\Request;

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

// Route::get('/user-profile', function () {
// 
//     // return view('profile.show', [
//     //     // 'request' => $request,
//     //     // 'user' => $request->user(),
//     // ]);
// });

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
    
    // $permissions = Permission::pluck('name')->all();
    // dump($permissions);
    // foreach ($permissions as $key => $permission) {
    //     echo "$permission <br>";
    // }
    // $role = Role::where('name', 'user')->count();
    
    // dump(0 !== $role);
    // $guard = auth()->guard(); // Retrieve the guard
    // $sessionName = $guard->getName(); // Retrieve the session name for the guard
    // // The following extracts the name of the guard by disposing of the first
    // // and last sections delimited by "_"
    // $parts = explode("_", $sessionName);
    // unset($parts[count($parts)-1]);
    // unset($parts[0]);
    // $guardName = implode("_",$parts);
    // dump($guardName);
    if ($user = auth()->user()) {
        echo 'Роль user: ', $user->hasRole('user');
    }
    
    return view('welcome');
});



use App\Http\Controllers\Site\MainController;
// Route::get('main', [IndexController::class, 'getMainPage'])->name('main');
Route::get('main', [MainController::class, 'index'])->name('main');
// Route::get('main', function () {
//     return view('main');
// });
use App\Http\Controllers\Site\SinglePostController;
Route::get('show-post/{post_id}', [SinglePostController::class, 'index'])->name('single_post');

use App\Http\Controllers\Site\AuthorPostsController;
Route::get('show-posts-author/{user_id}', [AuthorPostsController::class, 'index'])->name('show_posts_author');

use App\Http\Controllers\Site\CategoryPostsController;
Route::get('show-posts-category/{category_id}', [CategoryPostsController::class, 'index'])->name('show_posts_category');

use App\Http\Controllers\Site\SearchPostsController;
Route::get('search', [SearchPostsController::class, 'index'])->name('search');



// Route::get('show-posts-author/{user_id}', [MainController::class, 'getArticlesOfAuthor'])->name('showPostsAuthor');
// Route::get('show-posts-category/{category}', [MainController::class, 'getArticlesOfCategory'])->name('showPostsCategory');




Route::middleware(['auth', 'verified', 'addingRoleToUser:user'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {    
    // Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::resource('posts', App\Http\Controllers\PostController::class)->middleware(['role:admin|user']);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});

