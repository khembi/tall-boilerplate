<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

/**
 * [Description AuthController]
 */
class AuthController extends Controller
{
    
    /**
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function googleRedirect(Request $request) : RedirectResponse
    {    
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        // $driver = Socialite::driver('google');
        // $token = $driver->getAccessTokenResponse($request->code);
        // dd($token['id_token']);
    }
}
