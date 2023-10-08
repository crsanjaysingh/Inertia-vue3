<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// blog 'prefix'=>'blog',
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/blogs', [BlogPostController::class, 'index'])->name('blogs');             
    Route::get('/add', [BlogPostController::class, 'create'])->middleware([HandlePrecognitiveRequests::class])->name('add');
    Route::post('/store', [BlogPostController::class, 'store'])->middleware([HandlePrecognitiveRequests::class])->name('blog.store');
    Route::get('/edit/{id}', [BlogPostController::class, 'edit'])->middleware([HandlePrecognitiveRequests::class])->name('blog.edit');
    Route::put('/update/', [BlogPostController::class, 'update'])->middleware([HandlePrecognitiveRequests::class])->name('blog.update');
    Route::delete('/destroy/{id}', [BlogPostController::class, 'destroy'])->name('blog.destroy');
   
    //users
    Route::get('/users', [UserController::class, 'index'])->name('user.listing');             
    

});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');   


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
