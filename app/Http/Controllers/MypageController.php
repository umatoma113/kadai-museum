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
        $favorites = Favorite::where('user_id', $user->id)->get();
        $visitedExhibitions = Exhibition::where('user_id', $user->id)->get();
        $favoriteReviews = Review::whereIn('facility_id', $favorites->pluck('facility_id'))->get();

        return view('mypage', compact('favorites', 'visitedExhibitions', 'favoriteReviews'));
    }
}
