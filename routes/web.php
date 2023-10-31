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

//MEMES
Route::controller(MemeController::class)->group(function () {
    Route::get('/', 'index')->name('meme.index');
    Route::get('/create-meme', 'create')->name('meme.create');
    Route::post('/guardar-imagen', 'save')->name('meme.save');
    Route::delete('/borrar-meme/{meme}', 'destroy')->name('meme.destroy');
    //Route::post('/upload-meme', 'store')->name('meme.store');
});

require __DIR__ . '/auth.php';
