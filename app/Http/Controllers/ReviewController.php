<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Museum;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $museum_id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'museum_id' => $museum_id,
            'content' => $request->content,
        ]);

        return redirect()->route('museum.show', $museum_id);
    }
}
