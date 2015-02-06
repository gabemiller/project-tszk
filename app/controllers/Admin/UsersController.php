<?php

namespace Admin;

use Divide\CMS\User;
use View;
use Input;
use Response;
use Exception;
use Redirect;
use Validator;
use Config;
use Image;
use File;
use Sentry;

class UsersController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Felhasználók');
        $this->layout->content = View::make('admin.users.index')
            ->with('users', User::all(['id','first_name','last_name','created_at','last_login','email','phone']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        View::share('title', 'Új felhasználó');
        $this->layout->content = View::make('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        try {

            $rules = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'numeric|digits_between:9,20'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
            $user = new User();

            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');
            $user->password = '12345';
            $user->activated = true;

            if ($user->save()) {
                $group = \Sentry::getGroupProvider()->findByName('Admin');
                $user->addGroup($group);
                return Redirect::back()->with('message', 'Az adminisztrátor felvétele sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az adminisztrátor felvétele nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az adminisztrátor felvétele nem sikerült!');
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
        $user = User::find($id);
        View::share('title', $user->getFullName());

        return View::make('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        View::share('title', 'Felhasználó módosítása');
        $this->layout->content = View::make('admin.users.edit')->with('user', User::find($id));
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
                'first_name' => 'required|alpha_num',
                'last_name' => 'required|alpha_num',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'numeric|digits_between:9,20'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
            $user = User::find($id);

            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');

            if ($user->save()) {
                return Redirect::back()->with('message', 'Az adminisztrátor módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az adminisztrátor módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az adminisztrátor módosítása nem sikerült!');
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

            $user = User::find($id);

            if ($user->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú felhasználó törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú felhasználó törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú felhasználó törlése nem sikerült!', 'status' => false]);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getLogin() {
        View::share('title', 'Bejelentkezés');

        return View::make('admin.users.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postLogin() {
        try {

            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
            );

            $user = Sentry::authenticate($credentials, false);

            return Redirect::route('admin.vezerlopult');
        } catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return Redirect::route('admin.bejelentkezes')->withInput()->with('error', 'Email szükséges a bejelentkezéshez!');
        } catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            return Redirect::route('admin.bejelentkezes')->withInput()->with('error', 'Jelszó szükséges a bejelentkezéshez!');
        } catch (\Cartalyst\Sentry\Users\WrongPasswordException $e) {
            return Redirect::route('admin.bejelentkezes')->withInput()->with('error', 'Rossz jelszó, vagy email!');
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::route('admin.bejelentkezes')->withInput()->with('error', 'A felhasználó nem található!');
        } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            return Redirect::route('admin.bejelentkezes')->withInput()->with('error', 'A felhasználó nincs aktiválva!');
        } catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            return Redirect::route('admin.bejelentkezes')->withInput()->with('error', 'A felhasználó fel van függesztve!');
        } catch (\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            return Redirect::route('admin.bejelentkezes')->withInput()->with('error', 'A felhasználó ki van tiltva!');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getLogout() {
        Sentry::logout();
        return Redirect::route('admin.bejelentkezes');
    }

    /**
     * 
     */
    public function postProfile($id) {
        try {

            $rules = array(
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'numeric|digits_between:9,20'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
            $user = User::find($id);

            $user->email = Input::get('email');
            $user->phone = Input::get('phone');

            if ($user->save()) {
                return Redirect::back()->with('message', 'Az adataid módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az adataid módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az adataid módosítása nem sikerült!');
            }
        }
    }

    /**
     * 
     */
    public function postPassword($id) {
        try {

            $rules = array(
                'oldPwd' => 'required',
                'newPwd' => 'required',
                'newPwd2' => 'required|same:newPwd'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
            $user = User::find($id);

            $user->password = Input::get('newPwd');

            if ($user->save()) {
                return Redirect::back()->with('message', 'A jelszó módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A jelszó módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A jelszó módosítása nem sikerült!');
            }
        }
    }

    /**
     * 
     */
    public function postProfilePicture($id) {

        try {

            $rules = array(
                'picture' => 'required|image'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }


            $img = Image::make(Input::file('picture'));

            $path = '/img/user/' . $id;

            $thumbPath = $path . '/thumb';

            if (!File::exists(public_path() . $path)) {
                File::makeDirectory(public_path() . $path, 0777, true);
            }

            if (!File::exists(public_path() . $thumbPath)) {
                File::makeDirectory(public_path() . $thumbPath, 0777, true);
            }

            $extension = Input::file('picture')->getClientOriginalExtension();

            $fileName = 'profile.' . $extension;

            $img->save(public_path() . $path . '/' . $fileName)->fit(250)->save(public_path() . $thumbPath . '/' . $fileName);


            if (File::exists(public_path() . $path . '/' . $fileName) && File::exists(public_path() . $thumbPath . '/' . $fileName)) {
                return Redirect::back()->with('message', 'A profilkép módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A profilkép módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A profilkép módosítása nem sikerült!');
            }
        }
    }

    /**
     * 
     */
    public function deleteProfilePicture($id) {
        try {
            $path = '/img/user/' . $id;
            if (File::exists(public_path() . $path) && File::deleteDirectory(public_path() . $path, true)) {
                return Redirect::back()->with('message', 'A profilkép törlése sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('A profilkép törlése nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('A profilkép módosítása nem sikerült!');
            }
        }
    }

}
