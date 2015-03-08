<?php

namespace Divide\CMS;

/**
 * Divide\CMS\DocumentCategory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Divide\CMS\Document[] $documents
 * @property-read \Divide\CMS\DocumentCategory $ancestor
 */
class DocumentCategory extends \Eloquent {

    protected $table = 'documentcategory';

    /**
     * @var array
     */
    protected $fillable = ['parent_id','name','slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documents() {
        return $this->belongsToMany('Divide\CMS\Document', 'document_documentcategory', 'documentcategory_id', 'document_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo('Divide\CMS\DocumentCategory', 'id', 'parent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function children() {
        return $this->belongsTo('Divide\CMS\DocumentCategory', 'id', 'parent');
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getCategories($id = 0, $default = false) {

        if($default) {
            $array = array(0 => 'Nincs');
        } else{
            $array = array();
        }
        foreach (DocumentCategory::where('id', '<>', $id)->get(['id', 'name']) as $docCategory) {
            $array[$docCategory->id] = $docCategory->name;
        }

        return $array;
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getArray() {

        $array = array(0 => 'Összes kategória');

        foreach (DocumentCategory::all(['id', 'name']) as $docCategory) {
            $array[$docCategory->id] = $docCategory->name;
        }

        return $array;
    }



}
