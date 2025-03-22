<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Museum;

class MuseumController extends Controller
{
    public function index()
    {
        $museums = Museum::all();

        return view('museum_top', ['museums' => $museums]);
    }

    public function show(int $id)
    {
        $museum = Museum::with('specialExhibitions')->findOrFail($id);

        return view('museums.show', ['museum' => $museum]);
    }
}

