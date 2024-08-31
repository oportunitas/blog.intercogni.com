<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleComponent extends Component {
    public $article;
    public function __construct($id) {
        $this->article = Article::find($id);
    }

    public function render(): View|Closure|string {
        return view('components.article');
    }
}
