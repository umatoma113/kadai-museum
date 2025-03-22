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

    public function show(SpecialExhibition $specialExhibition)
    {
        $specialExhibition->load('museum');

        return view('special_exhibition.show', compact('specialExhibition'));
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
        $user = Auth::user();

        $visited = $user->visitedExhibitions()->where('special_exhibition_id', $specialExhibition->id)->exists();

        if ($visited) {
            $user->visitedExhibitions()->detach($specialExhibition->id);
        } else {
            $user->visitedExhibitions()->attach($specialExhibition->id);
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
