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

    public function googleCallback(Request $request): RedirectResponse
    {
        $driver = Socialite::driver('google');
        $google_user = $driver->user();
        $user = User::firstOrNew([
            'google_id' => $google_user->id,
            'email' => $google_user->email,
        ]);

        // TODO: Improve code quality
        if (empty($user->name) && isset($google_user->name)) {
            $user->name = $google_user->name;
        }

        // TODO: Improve code quality
        if (empty($user->google_token) && isset($google_user->token)) {
            $user->google_token = $google_user->token;
        }

        // TODO: Improve code quality
        if (empty($user->google_refresh_token) && isset($google_user->refreshToken)) {
            $user->google_refresh_token = $google_user->refreshToken;
        }

        // TODO: Improve code quality
        if (empty($user->profile_picture_url) && isset($google_user->avatar)) {
            $user->profile_picture_url = $google_user->avatar;
        }

        if ($user->save()) {
            Auth::login($user);
            return redirect('/dashboard');
        }
    }
}
