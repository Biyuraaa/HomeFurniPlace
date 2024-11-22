<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;


class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller') {
            return view('dashboard.profile.index');
        } else {
            return view('pages.profile.index');
        }
    }
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        if (Auth::user()->role == 'admin') {
            return view('dashboard.profile.edit');
        } else {
            $categories = Category::all();
            return view('pages.profile.edit', compact('categories'));
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        try {

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($user->image) {
                    Storage::delete('public/images/users/' . $user->image);
                }

                // Simpan gambar baru
                $image = $request->file('image');
                $imageName = $user->name . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images/users/', $imageName);

                $user->image = $imageName;
            }

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();
            if (Auth::user()->role == 'admin') {
                return Redirect::route('profile.index')->with('status', 'profile-updated');
            } else {
                return Redirect::route('profile-user.index')->with('status', 'profile-updated');
            }
        } catch (\Throwable $th) {
            return Redirect::route('profile.index')->with('status', 'profile-updated-failed');
        }
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
