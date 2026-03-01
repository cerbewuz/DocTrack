<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->has('birthdate')) {
            $user->birthdate = $request->birthdate;
        }

        $user->save();

        return back()->with('status', 'profile-updated');
    }

    /**
     * Decrypt and serve the profile photo.
     */
    public function showPhoto($filename)
    {
        $path = 'ProfilePhoto/' . $filename;
        
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $encryptedContents = Storage::disk('public')->get($path);
        
        try {
            $decryptedContents = \Illuminate\Support\Facades\Crypt::decrypt($encryptedContents);
            return response($decryptedContents)->header('Content-Type', 'image/jpeg');
        } catch (\Exception $e) {
            // If decryption fails, return 404 instead of crashing with 500
            abort(404);
        }
    }

    /**
     * Update the user's password.
     */
    public function passwordUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Update the user's profile photo with AES-256 encryption.
     */
    public function photoUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_photo' => ['required', 'image', 'max:5120'], // 5MB max
        ]);

        $user = $request->user();

        if ($request->file('profile_photo')) {
            // Ensure directory exists
            if (!Storage::disk('public')->exists('ProfilePhoto')) {
                Storage::disk('public')->makeDirectory('ProfilePhoto');
            }

            // Delete old photo if it exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $file = $request->file('profile_photo');
            $fileName = time() . '_' . $file->getClientOriginalName() . '.enc';
            $contents = file_get_contents($file->getRealPath());
            
            // Encrypt content using Laravel's Crypt (AES-256-CBC)
            $encryptedContents = \Illuminate\Support\Facades\Crypt::encrypt($contents);
            
            $path = 'ProfilePhoto/' . $fileName;
            Storage::disk('public')->put($path, $encryptedContents);
            
            $user->profile_photo = $path;
            $user->save();
        }

        return back()->with('status', 'photo-updated');
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
