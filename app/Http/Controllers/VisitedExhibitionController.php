<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SpecialExhibition;

class VisitedExhibitionController extends Controller
{
    public function store(SpecialExhibition $specialExhibition)
    {
        $user = Auth::user();

        if (!in_array($specialExhibition->id, $user->visitedSpecialExhibitions ?? [])) {
            $user->visitedSpecialExhibitions[] = $specialExhibition->id;
            $user->save();
        }

        return back();
    }

    public function destroy(SpecialExhibition $specialExhibition)
    {
        $user = Auth::user();

        if (in_array($specialExhibition->id, $user->visitedSpecialExhibitions ?? [])) {
            $user->visitedSpecialExhibitions = array_diff($user->visitedSpecialExhibitions, [$specialExhibition->id]);
            $user->save();
        }

        return back();
    }

    public function index()
    {
        $user = Auth::user();
        $visitedSpecialExhibitions = SpecialExhibition::whereIn('id', $user->visitedSpecialExhibitions ?? [])->get();

        return view('mypage', compact('visitedSpecialExhibitions'));
    }
}
