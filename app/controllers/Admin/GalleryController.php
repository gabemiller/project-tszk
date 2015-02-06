<?php

namespace Admin;

use Divide\CMS\Gallery;
use Divide\CMS\Picture;
use Divide\CMS\Article;
use Divide\CMS\Event;
use Divide\CMS\Page;
use View;
use Input;
use Response;
use Exception;
use Image;
use Validator;
use Redirect;
use Config;
use File;
use Str;

class GalleryController extends \BaseController
{

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     * GET /admin\gallery
     *
     * @return Response
     */
    public function index()
    {
        View::share('title', 'Galériák');

        $this->layout->content = View::make('admin.gallery.index')
            ->with('galleries', Gallery::all(['id', 'name', 'created_at']));
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin\gallery/create
     *
     * @return Response
     */
    public function create()
    {
        View::share('title', 'Galéria létrehozása');

        $this->layout->content = View::make('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin\gallery
     *
     * @return Response
     */
    public function store()
    {

        try {

            $rules = array(
                'name' => 'required|unique:gallery',
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $gallery = new Gallery();

            $gallery->name = Input::get('name');
            $gallery->description = Input::get('description');

            if ($gallery->save()) {
                return Redirect::route('admin.galeria.kep.upload',array('id'=>$gallery->id))->with('message', 'A galéria feltöltése sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A galéria feltöltése nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A galéria feltöltése nem sikerült!');
            }
        }
    }

    /**
     * Display the specified resource.
     * GET /admin\gallery/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.gallery.show')->with('gallery', Gallery::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /admin\gallery/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        View::share('title', 'Galéria módosítása');

        $this->layout->content = View::make('admin.gallery.edit')->with('gallery', Gallery::find($id));
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin\gallery/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        try {

            $rules = array(
                'name' => 'required|unique:gallery,name,' . $id,
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $gallery = Gallery::find($id);

            $gallery->name = Input::get('name');
            $gallery->description = Input::get('description');

            if ($gallery->save()) {
                return Redirect::back()->with('message', 'A galéria módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A galéria módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A galéria módosítása nem sikerült!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin\gallery/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {

            $gallery = Gallery::find($id);

            Article::where('gallery_id', '=', $gallery->id)->update(array('gallery_id' => 0));
            Event::where('gallery_id', '=', $gallery->id)->update(array('gallery_id' => 0));
            Page::where('gallery_id', '=', $gallery->id)->update(array('gallery_id' => 0));

            if ($gallery->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú galéria törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú galéria törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú galéria törlése nem sikerült!', 'status' => false]);
            }
        }
    }

    /**
     *
     * @param type $id
     */
    public function getPicture($id)
    {
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.gallery.upload')->with('gallery', Gallery::find($id));
    }

    /**
     *
     */
    /* public function postPicture() {


      try {

      $img = Image::make(Input::file('files'));

      $gallery = Gallery::find(Input::get('id'));

      $path = '/img/gallery/' . $gallery->id;

      $thumbPath = $path . '/thumb';

      if (!File::exists(public_path() . $path)) {
      File::makeDirectory(public_path() . $path, 777, true);
      }

      if (!File::exists(public_path() . $thumbPath)) {
      File::makeDirectory(public_path() . $thumbPath, 777, true);
      }

      $extension = Input::file('files')->getClientOriginalExtension();

      $fileName = microtime(true) . '-' . Str::slug(Str::words($gallery->name, 3, '')) . '.' . $extension;

      $img->save(public_path() . $path . '/' . $fileName)->fit(250)->save(public_path() . $thumbPath . '/' . $fileName);


      if (File::exists(public_path() . $path . '/' . $fileName) && File::exists(public_path() . $thumbPath . '/' . $fileName)) {
      $picture = new Picture();

      $picture->gallery_id = $gallery->id;
      $picture->thumbnail_path = $thumbPath . '/' . $fileName;
      $picture->picture_path = $path . '/' . $fileName;
      $picture->name = $fileName;

      if ($picture->save()) {
      $gallery->touch();
      return Response::json(['file' => ['url' => $picture->picture_path, 'thumbnailUrl' => $picture->thumbnail_path, 'name' => $picture->name, 'deleteUrl' => '/admin/galeria/kep/' . $picture->id . '/delete']]);
      } else {
      return Response::json(['file' => ['url' => 'http://placehold.it/250/f2dede/a94442&text=Hiba!', 'thumbnailUrl' => 'http://placehold.it/100/f2dede/a94442&text=Hiba!', 'name' => 'Hiba történt!', 'deleteUrl' => null]]);
      }
      }
      } catch (Exception $e) {
      return Response::json(['file' => ['url' => 'http://placehold.it/250/f2dede/a94442&text=Hiba!', 'thumbnailUrl' => 'http://placehold.it/250/f2dede/a94442&text=Hiba!', 'name' => 'Hiba történt!', 'deleteUrl' => null]]);
      }
      } */


    public function postPicture()
    {

        try {

            // Van-e kiválasztott képfájl
            if (!Input::hasFile('images')) {
                return Redirect::back()->withInput()->withErrors('Nincs kiválasztva feltöltendő képfájl!');
            }

            //Galéria lekérdezése azonosító alapján
            $gallery = Gallery::find(Input::get('id'));

            //Teljes méretű képek elérési útvonala
            $path = '/img/gallery/' . $gallery->id;

            //Thumbnail méretű képek elérési útvonala
            $thumbPath = $path . '/thumb';

            //Könyvátrak létrehozása, ha még nem léteztek
            if (!File::exists(public_path() . $path)) {
                File::makeDirectory(public_path() . $path, 0777, true);
            }

            if (!File::exists(public_path() . $thumbPath)) {
                File::makeDirectory(public_path() . $thumbPath, 0777, true);
            }

            //Képek validálása
            foreach (Input::file('images') as $image) {

                //Szabályok
                $rules = array(
                    'file' => 'required|mimes:png,gif,jpeg|max:2048'
                );

                $validator = \Validator::make(array('file' => $image), $rules);

                //Validálás
                if ($validator->passes()) {

                    //Kép objektum létrehozása manipuláláshoz.
                    $imageForManipulation = Image::make($image);

                    //Fájlnév létrehozása.
                    $fileName = microtime(true) . '-' . Str::slug(Str::words($gallery->name, 3, '')) . '.' . $image->getClientOriginalExtension();

                    //Kép és thumbnail létrehozása és elmentése
                    $imageForManipulation->save(public_path() . $path . '/' . $fileName)->fit(250)->save(public_path() . $thumbPath . '/' . $fileName);

                    //Galériakép objektum létrehozása 
                    $picture = new Picture();

                    $picture->gallery_id = $gallery->id;
                    $picture->thumbnail_path = $thumbPath . '/' . $fileName;
                    $picture->picture_path = $path . '/' . $fileName;
                    $picture->name = $fileName;

                    if ($picture->save()) {
                        $gallery->touch();
                    } else {
                        return Redirect::back()->withErrors('Hiba történt a képfájl mentésekor! ' . $image->getClientOriginalName());
                    }

                } else {
                    return Redirect::back()->withErrors($validator->errors());
                }
            }

            return Redirect::back()->with('message', 'A képfájlok feltöltése sikeres volt!');

        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú galéria törlése nem sikerült!', 'status' => false]);
            }
        }
    }

    /**
     *
     */
    public function deletePicture($id)
    {
        $picture = Picture::find($id);

        if (File::delete(public_path() . '/' . $picture->picture_path) && File::delete(public_path() . '/' . $picture->thumbnail_path) && $picture->delete()) {
            return Response::json(['message' => 'A kép törlése sikerült!', 'status' => true]);
        } else {
            return Response::json(['message' => 'A kép törlése nem sikerült!', 'status' => false]);
        }
    }

}
