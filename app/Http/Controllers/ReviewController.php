<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Museum;
use App\Models\SpecialExhibition;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Museum $museum, SpecialExhibition $specialExhibition)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'special_exhibition_id' => $specialExhibition->id,
            'content' => $request->content,
        ]);

        return redirect()->route('museum.show', $museum->id);
    }

    public function myReviews()
    {
        $user = Auth::user();

        $reviews = $user->reviews;

        return view('mypage', compact('reviews'));
    }

    public function destroy($review_id)
    {
        $user = Auth::user();
        $review = $user->reviews()->findOrFail($review_id);

        $review->delete();

        return back()->with('success', '感想が削除されました');
    }

    public function addFavorite(Review $review)
    {
        if ($review->favorites()->where('user_id', Auth::id())->doesntExist()) {
            $review->favorites()->create(['user_id' => Auth::id()]);
        }

        return back();
    }

    public function removeFavorite(Review $review)
    {
        $review->favorites()->where('user_id', Auth::id())->delete();

        return back();
    }
}
