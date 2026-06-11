<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index(): View
    {
    return view('profil.index');
    }   
    
    public function edit(Request $request): View
    {
        return view('profil.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
{
    $user = $request->user();

    $request->validate([
        'name'     => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
        'no_hp'    => 'nullable|string|max:20',
        'alamat'   => 'nullable|string|max:500',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name     = $request->name;
    $user->username = $request->username;
    $user->email    = $request->email;
    $user->no_hp    = $request->no_hp;

    if ($user->role !== 'admin') {
        $user->alamat = $request->alamat;
    }

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return Redirect::route('profil.index')->with('success', 'Profil berhasil diperbarui.');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
