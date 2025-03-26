<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewFavoriteController;
use App\Http\Controllers\SpecialExhibitionController;
use App\Http\Controllers\FavoriteController;
//use App\Http\Controllers\VisitedExhibitionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [MuseumController::class, 'index'])->name('home');

Route::get('/museum/top', [MuseumController::class, 'index'])->name('museum_top');

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage/reviews', [ReviewController::class, 'myReviews'])->name('myreviews');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
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
Route::get('/museum/{museum}/special-exhibition/{specialExhibition}', [SpecialExhibitionController::class, 'show'])->name('special_exhibition.show');
Route::post('/museum/{museum}/special-exhibition/{specialExhibition}/reviews',  [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

//Route::middleware('auth')->group(function () {
    //Route::post('/special-exhibition/{specialExhibition}/visited', [VisitedExhibitionController::class, 'store'])->name('visited_exhibition.store');
    //Route::delete('/special-exhibition/{specialExhibition}/visited', [VisitedExhibitionController::class, 'destroy'])->name('visited_exhibition.destroy');
    //Route::get('/mypage/visited-exhibitions', [VisitedExhibitionController::class, 'index'])->name('visited_exhibition.index');
//});

Route::post('/reviews/{museum}/{specialExhibition}', [ReviewController::class, 'store'])->name('reviews.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/review/{review}/favorite/add', [ReviewFavoriteController::class, 'add'])->name('review.favorite.add');
    Route::delete('/review/{review}/favorite/remove', [ReviewFavoriteController::class, 'remove'])->name('review.favorite.remove');
    Route::get('/mypage/favorites', [ReviewFavoriteController::class, 'myFavorites'])->name('mypage.favorites');
});

Route::post('/museum/{museum}/favorite', [FavoriteController::class, 'store'])->name('museum.favorite.store')->middleware('auth');
Route::delete('/museum/{museum}/favorite', [FavoriteController::class, 'destroy'])->name('museum.favorite.destroy')->middleware('auth');

Route::resource('exhibitions', SpecialExhibitionController::class)->only(['index', 'show', 'store']);

require __DIR__.'/auth.php';
