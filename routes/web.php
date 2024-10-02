<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VoteController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;

Route::get('/', [HomeController::class, 'main']);

Route::get('/auth/github', function () {
    // dump('calling auth');

    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/api/auth/callback/github', function () {
    try {
        $githubUser = Socialite::driver('github')->user();
    } catch (ClientException $e) {
        return redirect('/')->with('error', 'Authentication failed or was cancelled.');
    }
    $user = User::firstOrCreate([
        'github_id' => $githubUser->getId(),
    ], [
        'name' => $githubUser->getName(),
        'email' => $githubUser->getEmail(),
        'avatar' => $githubUser->getAvatar(),
        'nickname' => $githubUser->getNickname(),
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/blogs/manage', [BlogController::class, 'manage'])->name('blogs.manage');
    // other routes that require authentication
});

Route::get('/blogs/view', [BlogController::class, 'view']);
Route::post('/blogs/add', [BlogController::class, 'add']);
Route::get('/blogs/{id}/edit', [BlogController::class, 'edit']);
Route::post('/blogs/{id}/edit/apply', [BlogController::class, 'applyEdit']);
Route::delete('/blogs/{id}/delete', [BlogController::class, 'delete']);

Route::post('/blogs/{id}/upvote', [VoteController::class, 'upvote'])->name('blogs.upvote');
Route::post('/blogs/{id}/downvote', [VoteController::class, 'downvote'])->name('blogs.downvote');