<?php

use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//image noor

//Route::get('image', [RegisteredUserController::class,'index'])->name('image.index');
//Route::get('image/create', [RegisteredUserController::class,'createImage'])->name('image.create');
//Route::post('image', [RegisteredUserController::class,'store'])->name('Data.store');

//image 2  noor
Route::controller(RegisteredUserController::class)->group(function(){
    Route::get('image-upload', 'index2');
    Route::post('image-upload', 'store2AfterCompress')->name('image.store');
});
require __DIR__.'/auth.php';
