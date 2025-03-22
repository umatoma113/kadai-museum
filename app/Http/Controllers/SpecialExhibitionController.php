<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialExhibition;
use Illuminate\Support\Facades\Auth;

class SpecialExhibitionController extends Controller
{
    public function index()
    {
        $exhibitions = SpecialExhibition::all();
        return view('special_exhibitions.index', compact('exhibitions'));
    }

    public function show($id)
    {
        $exhibition = SpecialExhibition::with('museum')->findOrFail($id);

        return view('special_exhibition.show', compact('special_exhibition'));
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

    public function toggleVisit(SpecialExhibition $specialExhibition)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $visited = $user->visitedExhibitions()->where('special_exhibition_id', $specialExhibition->id)->exists();

        if ($visited) {
            $user->visitedExhibitions()->detach($specialExhibition->id);
        } else {
            $user->visitedExhibitions()->attach($specialExhibition->id);
        }

        return response()->json([
            'visited' => !$visited,
        ]);
    }

    public function edit($id)
    {
        $exhibition = SpecialExhibition::findOrFail($id);
        return view('special_exhibitions.edit', compact('exhibition'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $exhibition = SpecialExhibition::findOrFail($id);
        $exhibition->update($request->all());

        return redirect()->route('special_exhibitions.show', $id)->with('success', '特別展情報が更新されました。');
    }

    public function destroy($id)
    {
        $exhibition = SpecialExhibition::findOrFail($id);
        $exhibition->delete();

        return redirect()->route('special_exhibitions.index')->with('success', '特別展が削除されました。');
    }
}
