<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewFavorite;
use Illuminate\Support\Facades\Auth;

class ReviewFavoriteController extends Controller
{
    public function favorite($review_id)
    {
        $user_id = Auth::id();
        $favorite = ReviewFavorite::where('user_id', $user_id)->where('review_id', $review_id)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            ReviewFavorite::create([
                'user_id' => $user_id,
                'review_id' => $review_id,
            ]);
        }

        return back();
    }
}
