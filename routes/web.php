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
| 美術館関連のページ
*/

Route::get('/', [MuseumController::class, 'index'])->name('home');
Route::get('/museum/top', [MuseumController::class, 'index'])->name('museum_top');
Route::get('/museum/{id}', [MuseumController::class, 'show'])->name('museum.show');
Route::get('/museum/{museum}/special-exhibition/{specialExhibition}', [SpecialExhibitionController::class, 'show'])->name('special_exhibition.show');

/*
|--------------------------------------------------------------------------
| ユーザー関連・マイページ・レビュー
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // マイページ関連
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::get('/mypage/reviews', [ReviewController::class, 'myReviews'])->name('myreviews');
    Route::get('/mypage/favorites', [ReviewFavoriteController::class, 'myFavorites'])->name('mypage.favorites');

    // ユーザー管理
    Route::resource('users', UsersController::class)->only(['index', 'show']);
    Route::get('/profile/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/profile', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/profile', [UsersController::class, 'destroy'])->name('users.destroy');

    // レビュー関連
    Route::post('/museum/{museum}/special-exhibition/{specialExhibition}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

    // お気に入り機能（レビュー）
    Route::post('/review/{review}/favorite/add', [ReviewFavoriteController::class, 'add'])->name('review.favorite.add');
    Route::delete('/review/{review}/favorite/remove', [ReviewFavoriteController::class, 'remove'])->name('review.favorite.remove');

    // お気に入り機能（美術館）
    Route::post('/museum/{museum}/favorite', [FavoriteController::class, 'store'])->name('museum.favorite.store');
    Route::delete('/museum/{museum}/favorite', [FavoriteController::class, 'destroy'])->name('museum.favorite.destroy');
});


/*
|--------------------------------------------------------------------------
| 展覧会関連
|--------------------------------------------------------------------------
*/
Route::resource('exhibitions', SpecialExhibitionController::class)->only(['index', 'show', 'store']);

require __DIR__.'/auth.php';