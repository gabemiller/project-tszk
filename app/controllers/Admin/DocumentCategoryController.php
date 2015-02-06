<?php

namespace Admin;

use Divide\CMS\DocumentCategory;
use View;
use Validator;
use Input;
use Redirect;
use Config;
use Str;
use File;
use Response;

class DocumentCategoryController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Show the form for creating a new resource.
     * GET /admin\documentcategory/create
     *
     * @return Response
     */
    public function create() {
        View::share('title', 'Dokumentum kategóriák');

        $this->layout->content = View::make('admin.documentcategory.create')
                                        ->with('docCategories', DocumentCategory::all())
                                        ->with('categories', DocumentCategory::getCategories(0,true));
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin\documentcategory
     *
     * @return Response
     */
    public function store() {
        try {

            $rules = array(
                'name' => 'required|unique:documentcategory'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $docCat = new DocumentCategory();

            $docCat->name = Input::get('name');
            $docCat->slug = Str::slug(Input::get('name'));
            $docCat->parent_id = is_numeric(Input::get('parent_id')) ? Input::get('parent_id') : null;


            if ($docCat->save()) {
                return Redirect::back()->with('message', 'A dokumentum kategória feltöltése sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum kategória feltöltése nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum kategória feltöltése nem sikerült!');
            }
        }
    }

    /**
     * Display the specified resource.
     * GET /admin/documentcategory/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /admin/documentcategory/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        View::share('title', 'Dokumentum kategória módosítása');

        $this->layout->content = View::make('admin.documentcategory.edit')
            ->with('docCategory', DocumentCategory::find($id))
            ->with('categories', DocumentCategory::getCategories($id));
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin/documentcategory/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        try {

            $rules = array(
                'name' => 'required|unique:documentcategory,name,' . $id
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $docCat = DocumentCategory::findOrFail($id);

            $docCat->name = Input::get('name');
            $docCat->slug = Str::slug(Input::get('name'));
            $docCat->parent_id = is_numeric(Input::get('parent_id')) ? Input::get('parent_id') : null;


            if ($docCat->save()) {
                return Redirect::back()->with('message', 'A dokumentum kategória módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum kategória módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum kategória módosítása nem sikerült!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin\documentcategory/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {

            $docCat = DocumentCategory::find($id);

            if ($docCat->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú dokumentum kategória törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú dokumentum kategória törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú dokumentum kategória törlése nem sikerült!', 'status' => false]);
            }
        }
    }

}
