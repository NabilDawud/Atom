<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use function Flasher\Prime\flash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        flash()->success('Profile updated successfully.');
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Create the user's profile information and Update mobile 
     */
    public function storeAndUpdate(Request $request)
    {
        $request->validate([
            'mobile' => 'nullable|string',
            'description' => 'required|string',
            'job' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        return   DB::transaction(function () use ($request) {

            auth()->user()->update($request->only('mobile'));

        auth()->user()->profile()->updateOrCreate([
            'user_id' => auth()->id(),
        ], [
            'job' => $request->job,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'custom');

            if (auth()->user()->profile && auth()->user()->profile->image) {
                File::delete(auth()->user()->profile->image->path);
            }
        }

        if (isset($path)) {

            auth()->user()->profile->image()->updateOrCreate([], [
                'path' => $path,
            ]);
        }
        flash()->success('Profile updated successfully.');
        return redirect()->route('profile.edit');
        });
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
        flash()->warning('Account deleted successfully.');
        return Redirect::to('/');
    }
}
