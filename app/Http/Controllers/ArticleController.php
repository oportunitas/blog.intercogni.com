<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller {
    public function index() {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function show($id) {
        $article = Article::findOrFail($id); // Retrieve the specific article
        return view('articles.show', compact('article'));
    }
}
