<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleRedirect(Request $request): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        $driver = Socialite::driver('google');
        $google_user = $driver->user();

        $user = User::updateOrCreate([
            'google_id' => $google_user->id,
            'email' => $google_user->email,
        ], [
            'name' => $google_user->name,
            'google_token' => $google_user->token,
            'google_refresh_token' => $google_user->refreshToken,
            'profile_picture_url' => $google_user->picture,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
