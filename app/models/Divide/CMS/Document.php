<?php

namespace Divide\CMS;

/**
 * Divide\CMS\Document
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Divide\CMS\DocumentCategory[] $categories
 */
class Document extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'path'];

    /**
     * @var string
     */
    protected $table = 'document';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('Divide\CMS\DocumentCategory', 'document_documentcategory', 'document_id', 'documentcategory_id');
    }


    /**
     * @return array
     */
    public function getCategoryIds()
    {
        $ids = array();

        foreach ($this->categories as $cat) {
            $ids[] = $cat->id;
        }

        return $ids;
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

    /**
     * @param string $format
     * @return mixed
     */
    public function getCreatedAt($format = 'Y. F j., l H:i')
    {
        return (new Date($this->created_at))->format($format);
    }

    /**
     * @param string $format
     * @return mixed
     */
    public function getUpdatedAt($format = 'Y. F j., l H:i')
    {
        return (new Date($this->updated_at))->format($format);
    }

}
