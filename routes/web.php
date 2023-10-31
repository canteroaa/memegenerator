<?php

use App\Http\Controllers\MemeController;
use App\Http\Controllers\ProfileController;
use App\Models\Meme;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

/* Route::get('/', function () {
    
    return Inertia::render('Index', [

    ]);
}); */


Route::controller(MemeController::class)->group(function () {

    Route::get('/', 'index')->name('meme.index');
    Route::get('/create-meme', 'create')->name('meme.create');
    Route::post('/guardar-imagen', 'save')->name('meme.save');
    Route::delete('/borrar-meme/{meme}', 'destroy')->name('meme.destroy');
    //Route::post('/upload-meme', 'store')->name('meme.store');

});


/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__.'/auth.php';
