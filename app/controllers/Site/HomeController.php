<?php

namespace Site;

use Divide\CMS\Page;
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

        $page = Page::find(4);

        $this->layout->content = View::make('index')
            ->with('page', $page);
    }

}
