<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
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

Route::resource('posts', PostController::class);
// Route::get('/{id}', [PostController::class, 'show']);

Route::get('/', function () {
    $post = Post::where('id', 1)->first();
    return view('post.show', [
        'post' => $post,
        'id' => 1,
    ]);
});

Route::get('/new/{id}', [PostController::class, 'create'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
