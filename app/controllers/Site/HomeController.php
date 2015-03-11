<?php

namespace Site;

use Divide\CMS\Article;
use Divide\CMS\Page;
use Divide\CMS\Picture;
use View;

class HomeController extends \BaseController
{

    protected $layout = '_frontend.master';

    /**
     * Display a listing of the resource.
     * GET /site\index
     *
     * @return Response
     */
    public function index()
    {
        View::share('title', 'Főoldal');

        $page = Page::find(4);

        $pictures = Picture::orderByRaw("RAND()")->limit(10)->get();

        $articles = Article::where('published', '=', true)->orderBy('created_at', 'desc')->limit(3)->get();

        $this->layout->content = View::make('index')
            ->with('page', $page)
            ->with('pictures', $pictures)
            ->with('articles', $articles);
    }

}
