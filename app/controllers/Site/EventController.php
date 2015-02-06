<?php

namespace Site;

use Divide\CMS\Event;
use View;
use Request;
use Conner\Tagging\Tag;


class EventController extends \BaseController {

    protected $layout = '_frontend.master';

    /**
     * Display a listing of the resource.
     * GET /site\event
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Események');

        //$events = Event::where('shows', '=', true)->orderBy('start', 'DESC')->select(['id', 'title', 'start', 'end', 'content'])->paginate(10);
        $events = Event::whereRaw('published = ? ORDER BY start_at DESC', array(true))->paginate(10);

        $this->layout->content = View::make('site.event.index')->with('events', $events);
    }

    /**
     * Display the specified resource.
     * GET /site\event/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
        $event = Event::find($id);
        
        View::share('title', $event->title);
        
        $this->layout->content = View::make('site.event.show')->with('event', $event)->with('url',Request::url());
    }
    
    /**
     * 
     * @param type $tagSlug
     */
    public function tag($id) {
        
        $tag = Tag::where('id','=',$id)->first();
        
        View::share('title', 'Események: '.$tag->name);
        
        $event = Event::withAnyTag($tag->name)->orderBy('created_at','desc')->paginate(10);

        $this->layout->content = View::make('site.event.tag')->with('events',$event)->with('tag',$tag);
    }

}
