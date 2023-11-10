<?php

namespace App\Http\Controllers;

use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileCollection;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function __invoke(Request $request)
    {
        dd($request->allFiles());
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function indexApi()
    {
        $users = QueryBuilder::for(User::class)
        ->allowedFilters('id')
        ->defaultSort('created_at')
        ->paginate();
        return new ProfileCollection($users);
    }

    public function storeApi(StoreProfileRequest $request)
    {
        $validated = $request->validated();
        $users = Auth::user()->create($validated);
        return new ProfileResource($users);
    }

    public function updateApi(ProfileUpdateRequest $request, User $profile)
    {
        $validated = $request->validated();
        //$uploadedAvatar = $request->avatar->store('public/uploads');
        //$validated->avatar=$request->avatar->hasName();
        $profile->update($validated);
        return new ProfileResource($profile);
    }

    public function showApi(Request $request, User $profile)
    {
        return (new ProfileResource($profile));
                
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
