<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewFavoriteController;
use App\Http\Controllers\SpecialExhibitionController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [MuseumController::class, 'index'])->name('home');

Route::get('/museum/top', function () {
    return view('museum_top');
})->name('museum_top');

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UsersController::class)->only(['index', 'show']);

    Route::get('/profile/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/profile', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/profile', [UsersController::class, 'destroy'])->name('users.destroy');
});

Route::get('/museum/{id}', [MuseumController::class, 'show'])->name('museum.show');
Route::get('/special-exhibition/{specialExhibition}', [SpecialExhibitionController::class, 'show'])->name('special_exhibition.show');
Route::post('/special-exhibition/{specialExhibition}/review', [ReviewController::class, 'store'])->middleware('auth')->name('review.store');
Route::post('/special-exhibition/{specialExhibition}/toggle-visit', [SpecialExhibitionController::class, 'toggleVisit'])->middleware('auth')->name('special_exhibition.toggle_visit');

Route::post('/review/{review}/favorite', [ReviewFavoriteController::class, 'toggle'])->middleware('auth')->name('review.favorite.toggle');

Route::post('/museum/{museum}/favorite', [FavoriteController::class, 'store'])->middleware('auth')->name('museum.favorite');
Route::delete('/museum/{museum}/favorite', [FavoriteController::class, 'destroy'])->middleware('auth')->name('museum.favorite.remove');

Route::resource('exhibitions', SpecialExhibitionController::class)->only(['index', 'show', 'store']);

require __DIR__.'/auth.php';
