<?php

namespace Admin;

use Divide\CMS\Article;
use Divide\CMS\Document;
use Divide\CMS\DocumentCategory;
use Divide\CMS\Event;
use Divide\CMS\Gallery;
use Divide\CMS\Menu;
use Divide\CMS\MenuItem;
use Divide\CMS\Page;
use Divide\Helper\Tag;
use Divide\Presenter\MenuItemPresenter;
use View;
use Response;
use Exception;
use Input;
use Validator;
use Redirect;

class MenuController extends \BaseController
{

    protected $layout = '_backend.master';

    /**
     * Show the form for creating a new resource.
     * GET /admin/menu/create
     *
     * @return Response
     */
    public function create()
    {
        View::share('title', 'Menüpontok');

        $this->layout->content = View::make('admin.menu.create')
            ->with('menuItems', MenuItem::all())
            ->with('menus', Menu::getMenus())
            ->with('parents', MenuItem::getMenuItems())
            ->with('types', MenuItem::types())
            ->with('articleTags', Tag::getArray())
            ->with('articles', Article::getArray())
            ->with('eventTags', Tag::getArray())
            ->with('events', Event::getArray())
            ->with('galleries', Gallery::getGalleries())
            ->with('pages', Page::getArray())
            ->with('documentCategories', DocumentCategory::getArray());

    }

    /**
     * Store a newly created resource in storage.
     * POST /admin/menu
     *
     * @return Response
     */
    public function store()
    {

        $rules = array(
            'name' => 'required',
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }

        $menuItem = new MenuItem();

        if (Input::has('type')) {
            $generatedUrl = MenuItemPresenter::generateUrl(Input::all());
        }

        $menuItem->menu_id = Input::get('menu_id');
        $menuItem->parent_id = intval(Input::get('parent_id')) > 0 ? Input::get('parent_id') : null;
        $menuItem->name = Input::get('name');
        $menuItem->type = Input::get('type');
        $menuItem->url = $generatedUrl;

        if ($menuItem->save()) {
            return Redirect::back()->with('message', 'A menüpont feltöltése sikerült!');
        } else {
            return Redirect::back()->withInput()->withErrors('A menüpont feltöltése nem sikerült!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /admin/menu/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        View::share('title', 'Menüpont szerkesztése');

        $this->layout->content = View::make('admin.menu.edit')
            ->with('menus', Menu::getMenus())
            ->with('parents', MenuItem::getMenuItems())
            ->with('menuItem', MenuItem::find($id))
            ->with('types', MenuItem::types())
            ->with('articleTags', Tag::getArray())
            ->with('articles', Article::getArray())
            ->with('eventTags', Tag::getArray())
            ->with('events', Event::getArray())
            ->with('galleries', Gallery::getGalleries())
            ->with('pages', Page::getArray())
            ->with('documentCategories', DocumentCategory::getArray());
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin/menu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        try {

            $rules = array(
                'name' => 'required',
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $menuItem = MenuItem::findOrFail($id);

            $menuItem->parent_id = intval(Input::get('parent_id')) > 0 ? Input::get('parent_id') : null;
            $menuItem->name = Input::get('name');

            if(Input::has('url_modification') && Input::get('url_modification')){
                $menuItem->url = MenuItemPresenter::generateUrl(Input::all());
            }

            if ($menuItem->save()) {
                return Redirect::back()->with('message', 'A menüpont módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A menüpont módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A menüpont módosítása nem sikerült!');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin/menu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {

            $menuItem = MenuItem::findOrFail($id);

            if ($menuItem->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú menüpont törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú menüpont törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú menüpont törlése nem sikerült!', 'status' => false]);
            }
        }
    }

}