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
use Illuminate\Support\Facades\Log;

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
        $user = Auth::user();
        $request->validated();

        try {
            $userImage = $user->image;
            if ($request->hasFile('image')) {
                $userImage = $this->handleFileUpload(
                    $request,
                    'image',
                    'public/images/users/',
                    $user->image
                );
            }
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'date_of_birth' => $request->date_of_birth,
                'image' => $userImage,
            ]);

            if (Auth::user()->role == 'admin' or Auth::user()->role == 'seller') {
                return redirect()->route('profile.index')->with('status', 'Profile updated successfully');
            } else {
                return redirect()->route('profile-user.index')->with('status', 'Profile updated successfully');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('profile.index')->with('status', 'Profile update failed');
        }
    }

    private function handleFileUpload($request, $fieldName, $path, $existingFile = null): ?string
    {
        if ($request->hasFile($fieldName)) {
            if ($existingFile) {
                Storage::delete($path . $existingFile);
            }
            $file = $request->file($fieldName);
            $fileName = $this->generateUniqueFileName($file, $request->input('name', 'file'));
            $file->storeAs($path, $fileName);
            return $fileName;
        }
        return $existingFile;
    }

    private function generateUniqueFileName($file, $prefix = ''): string
    {
        $extension = $file->getClientOriginalExtension();
        return $prefix . '-' . uniqid() . '.' . $extension;
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
