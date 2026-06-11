<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // HALAMAN SETTINGS
    public function index()
    {
        return view('settings');
    }

    // SAVE SETTINGS
    public function save(Request $request)
    {
    $theme    = $request->input('theme', 'light');
    $fontSize = $request->input('font_size', 'medium');

    return response()->json([
        'status'  => 'success',
        'message' => 'Preferensi berhasil disimpan!',
    ])
    ->cookie('theme_pref', $theme,    43200)
    ->cookie('font_pref',  $fontSize, 43200);
    }
}