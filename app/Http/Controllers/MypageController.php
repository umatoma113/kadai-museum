<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Exhibition;
use App\Models\Review;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // お気に入りの施設取得
        $favorites = Favorite::where('user_id', $user->id)->get();

        // 行った展覧会の取得
        $visitedExhibitions = Exhibition::where('user_id', $user->id)->get();

        // お気に入りした施設に関する他のユーザーの感想を取得
        $favoriteReviews = Review::whereIn('facility_id', $favorites->pluck('facility_id'))->get();

        return view('mypage', compact('favorites', 'visitedExhibitions', 'favoriteReviews'));
    }
}
