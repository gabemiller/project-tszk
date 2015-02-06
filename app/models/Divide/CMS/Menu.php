<?php

namespace Divide\CMS;

use Str;

/**
 * Divide\CMS\Menu
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Divide\CMS\MenuItem[] $menuitems
 */
class Menu extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuitems()
    {
        return $this->hasMany('Divide\CMS\MenuItem');
    }

    /**
     * @return string
     */
    public function slug()
    {
        return Str::slug($this->name);
    }


    /**
     * @return array
     */
    public static function getMenus()
    {
        $menus = array();

        foreach (static::all(['id', 'name']) as $menu) {
            $menus[$menu->id] = $menu->name;
        }

        return $menus;
    }
}