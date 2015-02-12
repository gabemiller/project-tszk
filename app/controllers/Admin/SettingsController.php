<?php

namespace Admin;

use View;
use Input;
use Artisan;
use Redirect;

class SettingsController extends \BaseController {

	protected $layout = '_backend.master';

	/**
	 * Display a listing of the resource.
	 * GET /admin\settings
	 *
	 * @return Response
	 */
	public function index()
	{
		View::share('title', 'Beállítások');

		$this->layout->content = View::make('admin.settings.index');
	}

	/**
	 *
	 */
	public function postMaintenance()
	{
		if(Input::has('maintenance') && Input::get('maintenance')){
			Artisan::call('down');
			return Redirect::back()->with('message', 'Az oldal karbantartás módba került!');
		}else{
			Artisan::call('up');
			return Redirect::back()->with('message', 'Az oldal újra aktív állapotban van!');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin\settings
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin\settings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin\settings/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin\settings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin\settings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}