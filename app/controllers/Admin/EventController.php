<?php

namespace Admin;

use Divide\CMS\Event;
use Divide\CMS\Gallery;
use View;
use Input;
use Response;
use Exception;
use Validator;
use Redirect;
use Config;

class EventController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     * GET /admin\event
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.event.index')
            ->with('events', Event::all(['id','title','start_at','end_at']));
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin\event/create
     *
     * @return Response
     */
    public function create() {
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.event.create')
            ->with('galleries', Gallery::getGalleries());
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin\event
     *
     * @return Response
     */
    public function store() {

        try {

            $rules = array(
                'title' => 'required|unique:events',
                'content' => 'required',
                'start_at' => 'required',
                'end_at' => 'required',
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $event = new Event();


            $event->title = Input::get('title');
            $event->content = Input::get('content');
            $event->start_at = Input::get('start_at');
            $event->end_at = Input::get('end_at');
            $event->published = Input::get('published') ? true : false;
            $event->gallery_id = intval(Input::get('gallery_id')) > 0 ? Input::get('gallery_id') : null;

            if ($event->save()) {
				if(Input::get('tags')){
					$event->tag(explode(',',Input::get('tags')));
				}
                return Redirect::back()->with('message', 'Az esemény feltöltése sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az esemény feltöltése nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az esemény feltöltése nem sikerült!');
            }
        }
    }

    /**
     * Display the specified resource.
     * GET /admin\event/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.event.show');
    }

    /**
     * Show the form for editing the specified resource.
     * GET /admin\event/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.event.edit')
            ->with('event', Event::find($id))->with('galleries', Gallery::getGalleries());
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin\event/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        try {

            $rules = array(
                'title' => 'required|unique:events,title,' . $id,
                'content' => 'required',
                'start_at' => 'required',
                'end_at' => 'required',
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $event = Event::find($id);


            $event->title = Input::get('title');
            $event->content = Input::get('content');
            $event->start_at = Input::get('start_at');
            $event->end_at = Input::get('end_at');
            $event->published = Input::get('published') ? true : false;
            $event->gallery_id = intval(Input::get('gallery_id')) > 0 ? Input::get('gallery_id') : null;
            $event->retag(explode(',',Input::get('tags')));

            if ($event->save()) {
                return Redirect::back()->with('message', 'Az esemény módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az esemény módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az esemény módosítása nem sikerült!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin\event/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {

            $event = Event::find($id);

            if ($event->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú esemény törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú esemény törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú esemény törlése nem sikerült!', 'status' => false]);
            }
        }
    }

}
