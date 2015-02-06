<?php

namespace Site;

use Divide\CMS\Article;
use View;

class HomeController extends \BaseController {

    protected $layout = '_frontend.master';

    /**
     * Display a listing of the resource.
     * GET /site\index
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Főoldal');

        $article = Article::where('published', '=', true)
            ->orderBy('created_at', 'DESC')
            ->select(['id', 'title', 'author_id', 'created_at', 'content','gallery_id'])
            ->take(2)->get();

        $this->layout->content = View::make('index')
            ->with('articles', $article);
    }

}
