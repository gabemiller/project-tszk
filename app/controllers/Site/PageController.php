<?php

namespace Site;

use Divide\CMS\Page;
use View;
use Request;

class PageController extends \BaseController {

    protected $layout = '_frontend.master';

    /**
     * Display the specified resource.
     * GET /site\page/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $page = Page::find($id);
        
        View::share('title', $page->title);

        $this->layout->content = View::make('site.page.show')->with('page', $page)->with('url', Request::url());
    }

}
