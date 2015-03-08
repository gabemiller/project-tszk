<?php

namespace Divide\Presenter;

use URL;
use Str;
use Divide\Helper\Tag;
use Divide\CMS\Article;
use Divide\CMS\Event;
use Divide\CMS\Gallery;
use Divide\CMS\DocumentCategory;
use Divide\CMS\Page;

class MenuItemPresenter
{

    /**
     * @param $input
     * @return null|string
     */
    public static function generateUrl($input)
    {
        switch ($input['type']) {
            case 'fooldal':
                return URL::route('fooldal', array(), false);
            case 'kulso-hivatkozas':
                return $input['url'];
            case 'bejegyzesek':
                if (intval($input['articleTag']) > 0) {
                    $tag = Tag::find($input['articleTag']);
                    return URL::route('hirek.tag', array('id' => $tag->id, 'tagSlug' => Str::slug($tag->slug)), false);
                } else {
                    return URL::route('hirek.index', array(), false);
                }
            case 'egy-bejegyzes':
                $article = Article::find($input['article_id']);
                return URL::route('hirek.show', array('id' => $article->id, 'title' => Str::slug($article->title)), false);
            case 'esemenyek':
                if (intval($input['eventTag']) > 0) {
                    $tag = Tag::find($input['eventTag']);
                    return URL::route('esemenyek.tag', array('id' => $tag->id, 'tagSlug' => Str::slug($tag->slug)), false);
                } else {
                    return URL::route('esemenyek.index', array(), false);
                }
            case 'egy-esemeny':
                $event = Event::find($input['event_id']);
                return URL::route('esemenyek.show', array('id' => $event->id, 'title' => Str::slug($event->title)), false);
            case 'galeriak':
                return URL::route('galeriak.index', array(), false);
            case 'egy-galeria':
                $gallery = Gallery::find($input['gallery_id']);
                return URL::route('galeriak.show', array('id' => $gallery->id, 'title' => Str::slug($gallery->name)), false);
            case 'egy-oldal':
                $page = Page::find($input['page_id']);
                return URL::route('oldalak.show', array('id' => $page->id, 'title' => Str::slug($page->title)), false);
            case 'dokumentumok':
                if (intval($input['document_category_id']) > 0) {
                    $docCat = DocumentCategory::find($input['document_category_id']);
                    return URL::route('dokumentumok.index', array('category'=>Str::slug($docCat->name)), false);
                } else {
                    return URL::route('dokumentumok.index', array(), false);
                }
            default:
                return null;
        }
    }
}