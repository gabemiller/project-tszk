<?php

namespace Divide\CMS;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use File;

/**
 * Divide\CMS\User
 *
 * @property-read mixed $activated
 * @property mixed $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$groupModel[] $groups
 */
class User extends \Cartalyst\Sentry\Users\Eloquent\User implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    /**
     * 
     */
    public function getRememberToken() {
        
    }

    /**
     * 
     */
    public function getRememberTokenName() {
        
    }

    /**
     * 
     * @param type $value
     */
    public function setRememberToken($value) {
        
    }
    
    /**
     * 
     * @return type
     */
    public function getRegistrationDate() {
        return substr(str_replace('-', '.', $this->created_at), 0, 16);
    }
    
    /**
     * 
     * @return type
     */
    public function getLastLogin() {
        return substr(str_replace('-', '.', $this->last_login), 0, 16);
    }
    
    /**
     * 
     * @return type
     */
    public function getFullName(){
        return $this->last_name . ' ' . $this->first_name;
    }
    
    /**
     * 
     * @return type
     */
    
    public function getThumbProfilePicture(){
        
        $thumb = '/img/user/'.$this->id.'/thumb/profile';
        
        if(File::exists(public_path() . $thumb .'.jpg')){
            return $thumb .'.jpg';
        }
        
        if(File::exists(public_path() . $thumb .'.jpeg')){
            return $thumb .'.jpeg';
        }
        
        if(File::exists(public_path() . $thumb .'.png')){
            return $thumb .'.png';
        }
        
        if(File::exists(public_path() . $thumb .'.bmp')){
            return $thumb .'.bmp';
        }
        
        if(File::exists(public_path() . $thumb .'.gif')){
            return $thumb .'.gif';
        } 
        
        return 'http://placehold.it/250&text=Nincs+kép!';
    }
    
    /**
     * 
     * @return string
     */
    public function getProfilePicture(){
        
        $thumb = '/img/user/'.$this->id.'/profile';
        
        if(File::exists(public_path() . $thumb .'.jpg')){
            return $thumb .'.jpg';
        }
        
        if(File::exists(public_path() . $thumb .'.jpeg')){
            return $thumb .'.jpeg';
        }
        
        if(File::exists(public_path() . $thumb .'.png')){
            return $thumb .'.png';
        }
        
        if(File::exists(public_path() . $thumb .'.bmp')){
            return $thumb .'.bmp';
        }
        
        if(File::exists(public_path() . $thumb .'.gif')){
            return $thumb .'.gif';
        } 
        
        return 'http://placehold.it/250&text=Nincs+kép!';
    }

}
