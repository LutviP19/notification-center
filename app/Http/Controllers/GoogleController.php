<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Laravel\Passport\RefreshTokenRepository;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\RedirectResponse|RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                $response = [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('userToken')->accessToken,
                ];
                return redirect()
                ->with($response)
                ->intended('dashboard');

            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('123456dummy')
                ]);

                Auth::login($newUser);

                $response = [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('userToken')->accessToken,
                ];
                return redirect()
                ->with($response)
                ->intended('dashboard');
            }

        } catch (Exception $e) {
            Log::error($e);
            //dump($e);
        }
    }
}
