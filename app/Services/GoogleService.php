<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GoogleService
{
    public static function link(): string
    {
        $params =
            [
                'redirect_uri' => config('services.google.redirect'),
                'response_type' => 'code',
                'client_id' => config('services.google.client_id'),
                'scope' => implode(' ', config('services.google.scope')),
            ];

        return 'https://accounts.google.com/o/oauth2/auth' . '?' . http_build_query($params);
    }

    public function login(Request $request)
    {
        $response = Http::asForm()->post('https://accounts.google.com/o/oauth2/token', [
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect_uri' => config('services.google.redirect'),
            'grant_type' => 'authorization_code',
            'code' => $request->get('code'),
        ]);

        $token = $response['access_token'];

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get('https://www.googleapis.com/oauth2/v1/userinfo');

        $user = User::query()->where('login', '=', $response['name'])->first();

        if (null === $user) {
            $user = User::updateOrCreate([
                    'email' => $response['email']
                ], [
                    'login' => $response['name'],
                    'email' => $response['email'],
                    'password' => Str::random(10),
                ]
            );
        }

        Auth::login($user);

        $request->session()->regenerate();
    }
}
