<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialExhibition;
use Illuminate\Support\Facades\Auth;
use App\Models\Museum;

class SpecialExhibitionController extends Controller
{
    public function index()
    {
        $exhibitions = SpecialExhibition::all();
        return view('special_exhibition.index', compact('exhibitions'));
    }

    public function show(Museum $museum, SpecialExhibition $specialExhibition)
    {
        $specialExhibition->load('museum', 'reviews');

        $favoritedReviewIds = auth()->check()
        ? auth()->user()->reviewFavorites()->pluck('review_id')->toArray()
        : [];

        return view('special_exhibition.show', compact('museum', 'specialExhibition', 'favoritedReviewIds'));
    }

    public function create()
    {
        return view('special_exhibitions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'museum_id' => 'required|exists:museums,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        SpecialExhibition::create($request->all());

        return redirect()->route('special_exhibitions.index')->with('success', '特別展が追加されました。');
    }

    public function visited(SpecialExhibition $specialExhibition)
    {
        $user = Auth::user();

        $visited = $user->specialExhibitions()->where('special_exhibition_id', $specialExhibition->id)->exists();

        if ($visited) {
            $user->specialExhibitions()->detach($specialExhibition->id);
        } else {
            $user->specialExhibitions()->attach($specialExhibition->id);
        }

        return back();
    }

    public function edit(SpecialExhibition $specialExhibition)
    {
        return view('special_exhibitions.edit', compact('specialExhibition'));
    }

    public function update(Request $request, SpecialExhibition $specialExhibition)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $specialExhibition->update($request->all());

        return redirect()->route('special_exhibitions.show', $specialExhibition)->with('success', '特別展情報が更新されました。');
    }

    public function destroy(SpecialExhibition $specialExhibition)
    {
        $specialExhibition->delete();

        return redirect()->route('special_exhibitions.index')->with('success', '特別展が削除されました。');
    }
}
