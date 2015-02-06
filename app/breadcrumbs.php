<?php

/**
 * -----------------------------------------------------------------------------
 * Site
 * -----------------------------------------------------------------------------
 * 
 * A cms-hez tartozó breadcrumb-ok.
 * 
 */

Breadcrumbs::register('fooldal', function($breadcrumbs) {
    $breadcrumbs->push('<i class="fa fa-home"></i>', route('fooldal'));
});

Breadcrumbs::register('hirek.show', function($breadcrumbs,$article) {
    $breadcrumbs->parent('fooldal');
    $breadcrumbs->push($article->title, route('hirek.show',$article->id));
});

Breadcrumbs::register('hirek.tag', function($breadcrumbs,$tag) {
    $breadcrumbs->parent('fooldal');
    $breadcrumbs->push('Hírek', route('fooldal'));
    $breadcrumbs->push($tag->name,route('hirek.tag',$tag->slug));
});

Breadcrumbs::register('esemenyek.index', function($breadcrumbs) {
    $breadcrumbs->parent('fooldal');
    $breadcrumbs->push('Események', route('esemenyek.index'));
});

Breadcrumbs::register('esemenyek.show', function($breadcrumbs,$event) {
    $breadcrumbs->parent('esemenyek.index');
    $breadcrumbs->push($event->title, route('esemenyek.show',$event->id));
});

Breadcrumbs::register('esemenyek.tag', function($breadcrumbs,$tag) {
    $breadcrumbs->parent('esemenyek.index');
    $breadcrumbs->push($tag->name,route('hirek.tag',$tag->slug));
});

Breadcrumbs::register('galeriak.index', function($breadcrumbs) {
    $breadcrumbs->parent('fooldal');
    $breadcrumbs->push('Galériák', route('galeriak.index'));
});

Breadcrumbs::register('galeriak.show', function($breadcrumbs,$gallery) {
    $breadcrumbs->parent('galeriak.index');
    $breadcrumbs->push($gallery->name, route('galeriak.show',$gallery->id));
});

Breadcrumbs::register('oldalak.show', function($breadcrumbs,$page) {
    $breadcrumbs->parent('fooldal');
    $breadcrumbs->push($page->title, route('oldalak.show',$page->id));
});

/**
 * -----------------------------------------------------------------------------
 * Admin
 * -----------------------------------------------------------------------------
 * 
 * A adminhoz tartozó breadcrumb-ok.
 * 
 */

Breadcrumbs::register('admin.vezerlopult', function($breadcrumbs) {
    $breadcrumbs->push('Vezérlőpult', route('admin.vezerlopult'));
});

/**
 * Article
 */

Breadcrumbs::register('admin.hir.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.vezerlopult');
    $breadcrumbs->push('Hírek', route('admin.hir.index'));
});

Breadcrumbs::register('admin.hir.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.hir.index');
    $breadcrumbs->push('Új hír', route('admin.hir.create'));
});

Breadcrumbs::register('admin.hir.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.hir.index');
    $breadcrumbs->push('Hír módosítása', route('admin.hir.edit'));
});

/**
 * Event
 */

Breadcrumbs::register('admin.esemeny.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.vezerlopult');
    $breadcrumbs->push('Események', route('admin.esemeny.index'));
});

Breadcrumbs::register('admin.esemeny.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.esemeny.index');
    $breadcrumbs->push('Új esemény', route('admin.esemeny.create'));
});

Breadcrumbs::register('admin.esemeny.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.esemeny.index');
    $breadcrumbs->push('Esemény módosítása', route('admin.esemeny.edit'));
});

/**
 * Gallery
 */

Breadcrumbs::register('admin.galeria.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.vezerlopult');
    $breadcrumbs->push('Galériák', route('admin.galeria.index'));
});

Breadcrumbs::register('admin.galeria.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.galeria.index');
    $breadcrumbs->push('Új galéria', route('admin.galeria.create'));
});

Breadcrumbs::register('admin.galeria.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.galeria.index');
    $breadcrumbs->push('Galéria módosítása', route('admin.galeria.edit'));
});

Breadcrumbs::register('admin.galeria.kep.upload', function($breadcrumbs) {
    $breadcrumbs->parent('admin.galeria.index');
    $breadcrumbs->push('Képfeltöltés', route('admin.galeria.kep.upload'));
});

/**
 * Page
 */

Breadcrumbs::register('admin.oldal.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.vezerlopult');
    $breadcrumbs->push('Oldalak', route('admin.oldal.index'));
});

Breadcrumbs::register('admin.oldal.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.oldal.index');
    $breadcrumbs->push('Új oldal', route('admin.oldal.create'));
});

Breadcrumbs::register('admin.oldal.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.oldal.index');
    $breadcrumbs->push('Oldal módosítása', route('admin.oldal.edit'));
});

/**
 * User
 */

Breadcrumbs::register('admin.felhasznalok.felhasznalo.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.vezerlopult');
    $breadcrumbs->push('Felhasználók', route('admin.felhasznalok.felhasznalo.create'));
});

Breadcrumbs::register('admin.felhasznalok.felhasznalo.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.felhasznalok.felhasznalo.index');
    $breadcrumbs->push('Új felhasználók', route('admin.felhasznalok.felhasznalo.create'));
});

Breadcrumbs::register('admin.felhasznalok.felhasznalo.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.felhasznalok.felhasznalo.index');
    $breadcrumbs->push('Felhasználó módosítása', route('admin.felhasznalok.felhasznalo.edit'));
});