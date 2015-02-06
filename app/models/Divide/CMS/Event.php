<?php

namespace Divide\CMS;

use Str;

/**
 * Divide\CMS\Event
 *
 * @property-read \Divide\CMS\Gallery $gallery
 * @property-read \Illuminate\Database\Eloquent\Collection|\Conner\Tagging\Tagged[] $tagged
 * @method static \Divide\CMS\Event withAllTags($tagNames) 
 * @method static \Divide\CMS\Event withAnyTag($tagNames) 
 */
class Event extends \Eloquent {

    use \Conner\Tagging\TaggableTrait;

    //protected $fillable = [];

    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery() {
        return $this->belongsTo('Divide\CMS\Gallery');
    }


    /**
     * @return int|mixed
     */
    public function getGalleryId(){
        return $this->gallery_id == 0 ? 0 : $this->gallery->id;
    }


    /**
     * @return string
     */
    public function getLink(){
        return 'esemenyek/'.$this->id.'/'.Str::slug($this->title);
    }

    /**
     * @param int $characters
     * @param string $end
     * @return string
     */
    public function getParragraph($characters = 500,$end = '...'){
        return Str::limit(strip_tags($this->content), $characters,$end);
    }

    /**
     * @return array
     */
    public static function getArray()
    {
        $arr = array();

        foreach (static::all(['id', 'title']) as $item) {
            $arr[$item->id] = $item->title;
        }

        return $arr;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getCreatedAt($format = 'Y. F j., l H:i')
    {
        return (new Date($this->created_at))->format($format);
    }

    /**
     * @param string $format
     * @return string
     */
    public function getUpdatedAt($format = 'Y. F j., l H:i')
    {
        return (new Date($this->updated_at))->format($format);
    }

}
