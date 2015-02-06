<?php

namespace Admin;

use Divide\CMS\Article;
use Divide\CMS\Event;
use Divide\CMS\Gallery;
use Divide\CMS\Page;
use View;
use Response;

class HomeController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Vezérlőpult');
        
        $this->layout->content = View::make('admin')->with('article',Article::count())->with('event',Event::count())->with('gallery',Gallery::count())->with('page',Page::count());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function login() {
        View::share('title', 'Bejelentkezés');
        
        $this->layout->content = View::make('admin');
    }
}
