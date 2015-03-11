<?php

namespace Site;

use Divide\CMS\Document;
use Divide\CMS\DocumentCategory;
use Input;
use View;

class DocumentController extends \BaseController
{

    protected $layout = '_frontend.master';

    /**
     * Display a listing of the resource.
     * GET /site\document
     *
     * @return Response
     */
    public function index($category = null)
    {
        View::share('title', 'Dokumentumok');

        if (isset($category)) {

            $cat = DocumentCategory::where('slug','=',$category)->first();

            $doc = Document::whereHas('categories', function ($q) use($cat) {
                $q->where('documentcategory_id', '=', $cat->id);

            })->orderBy('created_at','desc')->get();


        } else {
            $doc = Document::orderBy('created_at','desc')->get();
        }

        $this->layout->content = View::make('site.document.index')
            ->with('documents', $doc)
            ->with('categories', DocumentCategory::all(['id','name','slug']));
    }

}
