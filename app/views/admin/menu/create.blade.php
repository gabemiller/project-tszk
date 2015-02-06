@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Menüpontok</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('_backend.message')
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">

            {{Form::open(array('url' => URL::route('admin.menu-kezelo.store',array()),'method'=>'POST'))}}
            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Új menüpont</h3>
                </div>
                <div class="box-body">

                    <div class="form-group hidden">
                        {{Form::label('menu_id', 'Menü',array('class'=>'control-label'))}}
                        <div>
                            {{Form::select('menu_id', $menus,null,array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('parent_id', 'Szülő menüpont',array('class'=>'control-label'))}}
                        <div>
                            {{Form::select('parent_id', $parents,null,array('class'=>'form-control'))}}
                            <p class="help-block">Ez lesz a szülőmenüpontja az új menüpontnak.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('name', 'Név',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('text','name','',array('class'=>'form-control','placeholder'=>'Név'))}}
                            <p class="help-block">Ez lesz a menüpont neve.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('type', 'Típus',array('class'=>'control-label'))}}
                        <div>
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
                                {{Form::label('url', 'Külső hivatkozás',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::input('text','url','',array('class'=>'form-control','placeholder'=>'http://pelda.hu'))}}
                                    <p class="help-block">A hivatkozás URL címét kell megadni.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="bejegyzesek">
                            <div class="form-group">
                                {{Form::label('articleTag', 'Bejegyzés címke',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::select('articleTag', $articleTags,null,array('class'=>'form-control'))}}
                                    <p class="help-block">Kiválaszthatunk egy adott címkében szereplő híreket, vagy az összes hírt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="egy-bejegyzes">
                            <div class="form-group">
                                {{Form::label('article_id', 'Bejegyzés',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::select('article_id', $articles,null,array('class'=>'form-control'))}}
                                    <p class="help-block">Egy bejegyzést választhatunk ki a címe alapján.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="esemenyek">
                            <div class="form-group">
                                {{Form::label('eventTag', 'Esemény címke',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::select('eventTag', $eventTags,null,array('class'=>'form-control'))}}
                                    <p class="help-block">Kiválaszthatunk egy adott címkében szereplő eseményeket, vagy az összes eseménytt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="egy-esemeny">
                            <div class="form-group">
                                {{Form::label('event_id', 'Esemény',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::select('event_id', $events,null,array('class'=>'form-control'))}}
                                    <p class="help-block">Egy eseményt választhatunk ki a címe alapján.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="galeriak"></div>
                        <div class="tab-pane" id="egy-galeria">
                            <div class="form-group">
                                {{Form::label('gallery_id', 'Galéria',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::select('gallery_id', $galleries,null,array('class'=>'form-control'))}}
                                    <p class="help-block">Egy galériát választhatunk ki a címe alapján.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="egy-oldal">
                            {{Form::label('page_id', 'Oldal',array('class'=>'control-label'))}}
                            <div>
                                {{Form::select('page_id', $pages,null,array('class'=>'form-control'))}}
                                <p class="help-block">Egy oldalt választhatunk ki a címe alapján.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="dokumentumok"></div>
                    </div>

                </div>
                <div class="box-footer">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>
            {{Form::close()}}

        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Menüpontok</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-sortable">
                            <thead>
                            <tr>
                                <th class="table-col-xs sorter-false filter-false"><input type="checkbox" id="checkAll">
                                </th>
                                <th class="table-col-xs">Az</th>
                                <th class="table-col-xs">Sz_Az</th>
                                <th>Név</th>
                                <th>Url</th>
                                <th>Létrehozva</th>
                                <th>Módosítva</th>
                                <th class="table-col-xs sorter-false filter-false">Beállítások</th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('admin.menu.single',$menuItems,'menuItem','admin.menu.empty')
                            </tbody>
                            @include('_backend.table-footer')
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::button('Törlés',array('type'=>'button','class'=>'btn btn-danger btn-sm','id'=>'deleteButton'))}}
                </div>
            </div>

        </div>
    </div>
</section>
@stop