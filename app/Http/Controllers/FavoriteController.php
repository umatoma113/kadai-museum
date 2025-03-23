<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Museum;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Museum $museum)
    {
        $user = Auth::user();

        if ($user->favoriteMuseums === null) {
            $user->load('favorites');
        }

        if (!$user->favorites->contains($museum->id)) {
            Favorite::create(['user_id' => $user->id, 'museum_id' => $museum->id]);
        }

        return redirect()->route('museum.show', $museum->id);
    }

    public function destroy(Museum $museum)
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)->where('museum_id', $museum->id)->delete();

        return redirect()->route('museum.show', $museum->id);
    }

}
