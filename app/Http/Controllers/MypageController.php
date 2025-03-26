<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\SpecialExhibition;
use App\Models\Review;
use App\Models\ReviewFavorite;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $visitedSpecialExhibitions = SpecialExhibition::whereIn('id', auth()->user()->visitedSpecialExhibitions ?? [])->get();
        $reviewFavorites = ReviewFavorite::where('user_id', $user->id)
                ->with('review.specialExhibition')
                ->get();

        return view('mypage', compact('favorites', 'reviewFavorites'));
    }
}
