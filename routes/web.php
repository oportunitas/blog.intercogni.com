<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    dump('calling welcome');
    return view(view: 'welcome');
});

Route::get('/auth/github', function () {
    dump('calling auth');
    return Socialite::driver('github')->redirect();
})->name('github.login');

// Route::get('/auth/github/callback', function () {
//     $user = Socialite::driver('github')->user();
 
//     // $user->token
// });

Route::get('/auth/github/callback', function() {
    $github_user =  Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'github_id' => $github_user->id,
    ], [
        'name' => $github_user->name,
        'email' => $github_user->email,
        'github_token' => $github_user->token,
        'github_refresh_token' => $github_user->refreshToken
    ]);

    Auth::login($user);

    return redirect('/');
});