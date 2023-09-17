<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $apiUrl = 'https://suporte.pm.sc.gov.br/apirest.php/initSession/';
        $AuthToken = 'Uv7qaMuxBhR71xyx2Jc2andq3AjxvzyvcrVd8EZX';
        $AppToken = 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1';

        $response = Http::withHeaders([
            'Authorization' => $AuthToken,
            'App-Token' => $AppToken,
        ])->withBasicAuth('933270', 'RL327#Hs')->withOptions(['verify' => false])->get($apiUrl);

        $responseData = $response->json();
//        dd($responseData['session_token']);
        Session::put('session_token', $responseData);
        auth()->user()->update([
            'authorization' => $AuthToken,
            'sessiontoken' => $responseData['session_token'],
        ]);



        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
