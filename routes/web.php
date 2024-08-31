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
    return Socialite::driver('github')->stateless()->redirect();
})->name('github.login');

Route::get('/auth/github/callback', function() {
    $githubUser = Socialite::driver('github')->stateless()->user();

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken
    ]);

    Auth::login($user);

    return redirect('/');
});