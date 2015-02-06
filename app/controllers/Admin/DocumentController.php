<?php

namespace Admin;

use Divide\CMS\Document;
use Divide\CMS\DocumentCategory;
use View;
use Validator;
use Input;
use Redirect;
use Config;
use Str;
use File;
use Response;

class DocumentController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     * GET /admin\document
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Dokumentumok');

        $this->layout->content = View::make('admin.document.index')
            ->with('documents', Document::all(['id', 'name','path', 'created_at','updated_at']));
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin\document/create
     *
     * @return Response
     */
    public function create() {
        View::share('title', 'Új dokumentum');

        $this->layout->content = View::make('admin.document.create')
            ->with('categories',DocumentCategory::getCategories());
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin\document
     *
     * @return Response
     */
    public function store() {
        try {

            $rules = array(
                'name' => 'required|unique:document',
                'file' => 'required'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $doc = new Document();

            $doc->name = Input::get('name');
            $doc->description = Input::get('description');

            $file = Input::file('file');

            $path = '/documents';

            if (!File::exists(public_path() . $path)) {
                File::makeDirectory(public_path() . $path, 0777, true);
            }

            $fileName = Str::slug($doc->name) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path() . $path, $fileName);

            $doc->path = $path . '/' . $fileName;

            if ($doc->save()) {
                $doc->categories()->sync(Input::get('category'));
                return Redirect::back()->with('message', 'A dokumentum feltöltése sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum feltöltése nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum feltöltése nem sikerült!');
            }
        }
    }

    /**
     * Display the specified resource.
     * GET /admin\document/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $doc = Document::find($id);

        View::share('title', 'Dokumentum: ' . $doc->name);

        $this->layout->content = View::make('admin.document.show')->with('document', $doc);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /admin\document/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $doc = Document::find($id);
        View::share('title', 'Dokumentum szerkesztése: ' . $doc->name);

        $this->layout->content = View::make('admin.document.edit')
            ->with('document', $doc)
            ->with('catIds',$doc->getCategoryIds())
            ->with('categories',DocumentCategory::getCategories());
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin\document/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        try {

            $rules = array(
                'name' => 'required|unique:document,name,' . $id,
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $doc = Document::find($id);

            $doc->name = Input::get('name');
            $doc->description = Input::get('description');



            if (Input::hasFile('file')) {

                if (File::exists(public_path() . $doc->path)) {
                    File::delete(public_path() . $doc->path);
                }

                $file = Input::file('file');

                $path = '/documents';

                if (!File::exists(public_path() . $path)) {
                    File::makeDirectory(public_path() . $path, 0777, true);
                }

                $fileName = Str::slug($doc->name) . '.' . $file->getClientOriginalExtension();

                $file->move(public_path() . $path, $fileName);

                $doc->path = $path . '/' . $fileName;
            } else {

                if (!File::exists($doc->path)) {

                    $path = '/documents';

                    $fileName = Str::slug($doc->name) . '.' . File::extension($doc->path);

                    File::move(public_path() . $doc->path, public_path() . $path . '/' . $fileName);

                    $doc->path = $path . '/' . $fileName;
                }
            }

            if ($doc->save()) {
                $doc->categories()->sync(Input::get('category'));
                return Redirect::back()->with('message', 'A dokumentum feltöltése sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum feltöltése nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A dokumentum feltöltése nem sikerült!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin\document/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {

            $doc = Document::find($id);

            if (File::exists(public_path() . $doc->path)) {
                File::delete(public_path() . $doc->path);
            }

            if ($doc->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú dokumentum törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú dokumentum törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú dokumentum törlése nem sikerült!', 'status' => false]);
            }
        }
    }

}
