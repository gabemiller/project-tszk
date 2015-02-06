<?php

namespace Admin;

use Divide\CMS\Article;
use Divide\CMS\Gallery;
use View;
use Input;
use Response;
use Exception;
use Validator;
use Redirect;
use Config;

class ArticleController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     * GET /admin\article
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Hírek');

        $this->layout->content = View::make('admin.article.index')->with('articles', Article::all(['id', 'author_id', 'title', 'created_at']));
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin\article/create
     *
     * @return Response
     */
    public function create() {
        View::share('title', 'Új hír');

        $this->layout->content = View::make('admin.article.create')->with('galleries', Gallery::getGalleries());
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin\article
     *
     * @return Response
     */
    public function store() {


        try {

            $rules = array(
                'title' => 'required|unique:articles',
                'content' => 'required',
                'author_id' => 'required',
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $article = new Article();


            $article->title = Input::get('title');
            $article->author_id = Input::get('author_id');
            $article->content = Input::get('content');
            $article->published = Input::get('published') ? true : false;
            $article->gallery_id = intval(Input::get('gallery')) > 0 ? Input::get('gallery') : null;


            if ($article->save()) {
                if (Input::get('tags')) {
                    $article->tag(explode(',', Input::get('tags')));
                }
                return Redirect::back()->with('message', 'A hír feltöltése sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A hír feltöltése nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A hír feltöltése nem sikerült!');
            }
        }
    }

    /**
     * Display the specified resource.
     * GET /admin\article/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        View::share('title', 'Hír');

        $this->layout->content = View::make('admin.article.show');
    }

    /**
     * Show the form for editing the specified resource.
     * GET /admin\article/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        View::share('title', 'Hír módosítása');

        $this->layout->content = View::make('admin.article.edit')
            ->with('article', Article::find($id))->with('galleries', Gallery::getGalleries());
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin\article/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        try {

            $rules = array(
                'title' => 'required|unique:articles,title,' . $id,
                'content' => 'required',
                'author_id' => 'required',
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $article = Article::find($id);


            $article->title = Input::get('title');
            $article->author_id = Input::get('author_id');
            $article->content = Input::get('content');
            $article->published = Input::get('published') ? true : false;
            $article->gallery_id = intval(Input::get('gallery_id')) > 0 ? Input::get('gallery_id') : null;
            $article->retag(explode(',', Input::get('tags')));

            if ($article->save()) {
                return Redirect::back()->with('message', 'A hír módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A hír módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A hír módosítása nem sikerült!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin\article/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {

            $article = Article::find($id);

            if ($article->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú hír törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú hír törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú hír törlése nem sikerült!', 'status' => false]);
            }
        }
    }

}
