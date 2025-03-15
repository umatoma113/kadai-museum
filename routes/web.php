<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MypageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('museum_top');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/profile', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/profile', [UsersController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';
