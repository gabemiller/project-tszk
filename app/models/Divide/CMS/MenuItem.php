<?php

namespace Divide\CMS;

use URL;
use Str;

/**
 * Divide\CMS\MenuItem
 *
 * @property-read \Divide\CMS\Menu $menu
 */
class MenuItem extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['menu_id', 'parent_id', 'name', 'type', 'url'];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'menuitem';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('Divide\CMS\Menu');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne('Divide\CMS\MenuItem', 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('Divide\CMS\MenuItem', 'parent_id', 'id');
    }

    /**
     * @return array
     */
    public static function types()
    {
        return array('fooldal' => 'Főoldal',
            'kulso-hivatkozas' => 'Külső hivatkozás',
            'bejegyzesek' => 'Bejegyzések',
            'egy-bejegyzes' => 'Egy bejegyzés',
            'esemenyek' => 'Események',
            'egy-esemeny' => 'Egy esemény',
            'galeriak' => 'Galériák',
            'egy-galeria' => 'Egy galéria',
            'egy-oldal' => 'Egy oldal',
            'dokumentumok' => 'Dokumentumok');
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getMenuItems($id = 0)
    {

        $menuItems = array(0 => 'Nincs szülőmenüpont!');

        foreach (static::where('id', '<>', $id)->get(['id', 'parent_id', 'name']) as $menuItem) {

            if ($menuItem->parent) {
                $menuItems[$menuItem->id] = $menuItem->parent->name . ' > ' . $menuItem->name;
            } else {
                $menuItems[$menuItem->id] = $menuItem->name;
            }
        }

        return $menuItems;
    }

    /**
     * @param $menu
     * @param $id
     */
    public static function generateMenu($menu, $id)
    {
        $menuItems = MenuItem::where('parent_id', '=', $id)->get();

        if ($id == null) {
            foreach ($menuItems as $menuItem) {
                $menu->add($menuItem->name, array('url' => URL::to($menuItem->url)));
                static::generateMenu($menu, $menuItem->id);
            }
        } else {
            foreach ($menuItems as $menuItem) {
                $parent = MenuItem::find($menuItem->parent_id);
                $menu->get(Str::camel($parent->name))->add($menuItem->name, array('url' => URL::to($menuItem->url)));
                static::generateMenu($menu, $menuItem->id);
            }
        }
    }

}