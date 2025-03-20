<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Museum;

class MuseumController extends Controller
{
    public function index()
    {
        $museums = Museum::all();

        return view('museum_top', compact('museums'));
    }

    public function show($id)
    {
        $museum = Museum::findOrFail($id);

        return view('museums.show', compact('museum'));
    }
}

