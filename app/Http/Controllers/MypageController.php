<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\SpecialExhibition;
use App\Models\Review;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $visitedSpecialExhibitions = $user->specialExhibitions;
        $favoriteReviews = Review::whereIn('special_exhibition_id', $favorites->pluck('museum_id'))->get();

        return view('mypage', compact('favorites', 'visitedSpecialExhibitions', 'favoriteReviews'));
    }
}
