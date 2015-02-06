<?php

namespace Admin;

use View,
    Input,
    Exception,
    Response,
    Groups;

class GroupsController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        View::share('title','Felhasználói csoportok');
        $this->layout->content = View::make('admin.groups.index')->with('usergroups',Groups::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $this->layout->content = View::make('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        var_dump(\Input::all());
        die();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $this->layout->content = View::make('admin.groups.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $this->layout->content = View::make('admin.groups.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
