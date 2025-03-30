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

        if (!$user->favorites()->where('museum_id', $museum->id)->exists()) {
            $user->favorites()->attach($museum->id);
        }

        return redirect()->route('museum.show', $museum->id);
    }

    public function destroy(Museum $museum)
    {
        $user = Auth::user();

        $user->favorites()->detach($museum->id);

        return redirect()->route('museum.show', $museum->id);
    }

}
