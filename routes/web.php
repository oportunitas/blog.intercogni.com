<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [HomeController::class, 'main']);

// Route::get('/', function () {
//     dump('calling welcome');
//     return view('welcome');
// });

// Route::get('/blog', function () {
//     return view('blog', [ArticleController::class, 'index']);
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/articles', function () {
//     $articles = App\Models\Article::all();
//     return view('articles.index', compact('articles'));
// });

// Route::get('/articles', [ArticleController::class, 'index']);
// Route::get('/articles/{id}', [ArticleController::class, 'show']);

Route::get('/auth/github', function () {
    dump('calling auth');
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/auth/github/callback', function() {
    $githubUser = Socialite::driver('github')->user();

    $user = User::firstOrCreate([
        'github_id' => $githubUser->getId(),
    ], [
        'name' => $githubUser->getName(),
        'email' => $githubUser->getEmail(),
        'avatar' => $githubUser->getAvatar(),
        'nickname' => $githubUser->getNickname(),
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken
    ]);

    Auth::login($user);

    return redirect('/');
});