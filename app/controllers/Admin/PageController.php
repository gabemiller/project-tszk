<?php

namespace Admin;

use Divide\CMS\Page;
use Divide\CMS\Gallery;
use View;
use Input;
use Response;
use Exception;
use Validator;
use Redirect;
use Config;

class PageController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.page.index')->with('pages', Page::all(['id','title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        View::share('title', 'Oldal létrehozás');

        $this->layout->content = View::make('admin.page.create')->with('galleries', Gallery::getGalleries());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        try {

            $rules = array(
                'title' => 'required|unique:pages',
                'content' => 'required'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $page = new Page();

            $page->title = Input::get('title');
            $page->content = Input::get('content');
            $page->gallery_id = intval(Input::get('gallery_id')) > 0 ? Input::get('gallery_id') : null;
            $page->published = Input::get('published') ? true : false;

            if ($page->save()) {
                return Redirect::back()->with('message', 'Az oldal létrehozása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az oldal létrehozása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az oldal létrehozása nem sikerült!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

        $page = Page::find($id);
        View::share('title', 'Oldal: ' . $page->name);
        $this->layout->content = View::make('admin.page.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $page = Page::find($id);
        View::share('title', 'Oldal: ' . $page->title);
        $this->layout->content = View::make('admin.page.edit')->with('page', $page)->with('galleries', Gallery::getGalleries());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        try {

            $rules = array(
                'title' => 'required|unique:pages,title,' . $id,
                'content' => 'required'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $page = Page::find($id);

            $page->title = Input::get('title');
            $page->content = Input::get('content');
            $page->gallery_id = intval(Input::get('gallery_id')) > 0 ? Input::get('gallery_id') : null;
            $page->published = Input::get('published') ? true : false;

            if ($page->save()) {
                return Redirect::back()->with('message', 'Az oldal módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az oldal módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az oldal módosítása nem sikerült!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        try {

            $page = Page::find($id);

            if ($page->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú oldal törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú oldal törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú oldal törlése nem sikerült!', 'status' => false]);
            }
        }
    }

}
