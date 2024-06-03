<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GitHubService;
use App\Services\GoogleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $conditionals = $request->validate(
            [
                'email' => ['required', 'email', 'unique:users'],
                'login' => ['required', 'string', 'min:3', 'unique:users'],
                'password' => ['required', 'min:8']
            ]
        );

        $user =  User::query()->where('login', '=', $conditionals['login'])->first();

        if (null === $user) {
            $user = User::create($request->all());

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('auth.user');
        }
    }

    public function login(Request $request)
    {
        $conditionals = $request->validate(
            [
                'login' => ['required', 'string', 'min:3'],
                'password' => ['required', 'min:8']
            ]
        );

        $user =  User::query()->where('login', '=', $conditionals['login'])->first();

        if ($user->exists() && Hash::check($conditionals['password'], $user->password)) {
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('auth.user');
        }

        return redirect()->route('auth.index')->withErrors(['password' => 'Пароли не совпадают'])->withInput();
    }

    public function user()
    {
        return view('auth.user');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function loginByGoogle(GoogleService $service, Request $request)
    {
        $service->login($request);

        return redirect()->route('auth.user');
    }

    public function loginByGitHub(GitHubService $service, Request $request)
    {
        $service->login();

        return redirect()->route('auth.user');
    }
}
