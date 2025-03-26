<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewFavorite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewFavoriteController extends Controller
{
    public function review()
    {
    return $this->belongsTo(Review::class);
    }

    public function add($review_id)
    {
        $user_id = Auth::id();
        //dd(Review::find($review_id));
        //dd($review_id);
        $review_id = (int) $review_id;
        $review = Review::find($review_id);
        //dd($review->id);
        //dd($review);

        //$review = Review::findOrFail($review_id);

        $exists = ReviewFavorite::where('user_id', $user_id)
                                ->where('review_id', $review->id)
                                ->exists();

        if (!$exists) {
            ReviewFavorite::create([
                'user_id' => $user_id,
                'review_id' => $review->id,
            ]);
        }

        return back();
    }

    public function remove($review_id)
    {
        $user_id = Auth::id();

        ReviewFavorite::where('user_id', $user_id)
                        ->where('review_id', $review_id)
                        ->delete();

        return back();
    }

    public function myFavorites()
    {
        $user = Auth::user();
        $favorites = $user->reviewFavorites()->with('review.specialExhibition.museum')->get();

        return view('mypage', compact('favorites'));
    }
}
