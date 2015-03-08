@extends('_backend.master')
@section('content')
    <section class="content-header">
        <h1>Menüpont módosítása</h1>
        {{-- HTML::decode(Breadcrumbs::render('')) --}}
    </section>

    <section class="content">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('_backend.message')
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                {{Form::open(array('url' => URL::route('admin.menu-kezelo.update',array('id'=>$menuItem->id)),'class'=>'form-horizontal','method'=>'PUT'))}}
                <div class="box box-solid">
                    <div class="box-body">
                        {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm btn-copy'))}}
                    </div>
                </div>

                <div class="box box-solid box-divide">
                    <div class="box-header">
                        <h3 class="box-title">Menüpont módosítása</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group hidden">
                            {{Form::label('menu_id', 'Menü',array('class'=>'col-lg-2 control-label'))}}
                            <div class="col-lg-9">
                                {{Form::select('menu_id', $menus,$menuItem->menu_id,array('class'=>'form-control'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('parent_id', 'Szülő menüpont',array('class'=>'col-lg-2 control-label'))}}
                            <div class="col-lg-9">
                                {{Form::select('parent_id', $parents,$menuItem->parent_id,array('class'=>'form-control'))}}
                                <p class="help-block">Ez a szülőmenüpontja a menüpontnak.</p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('name', 'Név',array('class'=>'col-lg-2 control-label'))}}
                            <div class="col-lg-9">
                                {{Form::input('text','name',$menuItem->name,array('class'=>'form-control','placeholder'=>'Név'))}}
                                <p class="help-block">Ez a neve a menüpontnak.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('url', 'URL',array('class'=>'col-lg-2 control-label'))}}
                            <div class="col-lg-9">
                                {{Form::input('text','',$menuItem->url,array('class'=>'form-control','disabled'))}}
                                {{Form::input('hidden','url',$menuItem->url,array('class'=>'form-control'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('url_modification', 'Szeretnéd módosítani az URL-t?',array('class'=>'col-lg-2 control-label'))}}
                            <div class="col-lg-9">
                                {{Form::checkbox('url_modification', 'true')}}
                            </div>
                        </div>

                        <div class="url_state">
                            <div class="form-group">
                                {{Form::label('type', 'Típus',array('class'=>'col-lg-2 control-label'))}}
                                <div class="col-lg-9">
                                    {{Form::select('type', $types,null,array('class'=>'form-control'))}}
                                    <p class="help-block">Ez fog megjelenni a menüpontra kattintva.</p>
                                </div>
                            </div>


                            <ul class="nav nav-tabs hidden" role="tablist">
                                @foreach($types as $key => $value)
                                    <li><a href="#{{$key}}" role="tab" data-toggle="tab">{{$value}}</a></li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="fooldal"></div>
                                <div class="tab-pane" id="kulso-hivatkozas">
                                    <div class="form-group">
                                        {{Form::label('url', 'Külső hivatkozás',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::input('text','url','',array('class'=>'form-control','placeholder'=>'http://pelda.hu'))}}
                                            <p class="help-block">A hivatkozás URL címét kell megadni.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="bejegyzesek">
                                    <div class="form-group">
                                        {{Form::label('articleTag', 'Bejegyzés címke',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::select('articleTag', $articleTags,null,array('class'=>'form-control'))}}
                                            <p class="help-block">Kiválaszthatunk egy adott címkében szereplő híreket,
                                                vagy
                                                az összes hírt.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="egy-bejegyzes">
                                    <div class="form-group">
                                        {{Form::label('article_id', 'Bejegyzés',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::select('article_id', $articles,null,array('class'=>'form-control'))}}
                                            <p class="help-block">Egy bejegyzést választhatunk ki a címe alapján.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="esemenyek">
                                    <div class="form-group">
                                        {{Form::label('eventTag', 'Esemény címke',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::select('eventTag', $eventTags,null,array('class'=>'form-control'))}}
                                            <p class="help-block">Kiválaszthatunk egy adott címkében szereplő
                                                eseményeket,
                                                vagy az összes eseménytt.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="egy-esemeny">
                                    <div class="form-group">
                                        {{Form::label('event_id', 'Esemény',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::select('event_id', $events,null,array('class'=>'form-control'))}}
                                            <p class="help-block">Egy eseményt választhatunk ki a címe alapján.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="galeriak"></div>

                                <div class="tab-pane" id="egy-galeria">
                                    <div class="form-group">
                                        {{Form::label('gallery_id', 'Galéria',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::select('gallery_id', $galleries,null,array('class'=>'form-control'))}}
                                            <p class="help-block">Egy galériát választhatunk ki a címe alapján.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="egy-oldal">
                                    <div class="form-group">
                                        {{Form::label('page_id', 'Oldal',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::select('page_id', $pages,null,array('class'=>'form-control'))}}
                                            <p class="help-block">Egy oldalt választhatunk ki a címe alapján.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="dokumentumok">
                                    <div class="form-group">
                                        {{Form::label('document_category_id', 'Dokumentum kategória',array('class'=>'col-lg-2 control-label'))}}
                                        <div class="col-lg-9">
                                            {{Form::select('document_category_id', $documentCategories,null,array('class'=>'form-control'))}}
                                            <p class="help-block">Egy kategóriát választhatunk ki a neve alapján.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </section>
@stop