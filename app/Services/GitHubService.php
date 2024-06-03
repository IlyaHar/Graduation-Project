<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitHubService
{
    public function login()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = \App\Models\User::updateOrCreate([
            'email' => $githubUser->email
        ], [
            'login' => $githubUser->nickname,
            'email' => $githubUser->email,
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        Auth::login($user);

        return redirect()->route('auth.user');
    }
}
