<?php

namespace Divide\CMS;

use Image;
use URL;
use Response;

/**
 * Divide\CMS\Picture
 *
 * @property-read \Divide\CMS\Gallery $gallery
 */
class Picture extends \Eloquent
{

    //protected $fillable = [];

    /**
     * @var string
     */
    protected $table = 'pictures';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery()
    {
        return $this->belongsTo('Divide\CMS\Gallery');
    }

    /**
     * @return array
     */
    public static function getArray()
    {
        $arr = array();

        foreach (static::all(['id', 'name']) as $item) {
            $arr[$item->id] = $item->name;
        }

        return $arr;
    }

}
