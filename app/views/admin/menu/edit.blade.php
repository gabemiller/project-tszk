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
                            <p class="help-block">Ez lesz a szülőmenüpontja az új menüpontnak.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('name', 'Név',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','name',$menuItem->name,array('class'=>'form-control','placeholder'=>'Név'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('type', 'Típus',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','',$menuItem->type,array('class'=>'form-control','disabled'))}}
                            {{Form::input('hidden','type',$menuItem->type,array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('url', 'URL',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','',$menuItem->url,array('class'=>'form-control','disabled'))}}
                            {{Form::input('hidden','url',$menuItem->url,array('class'=>'form-control'))}}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</section>
@stop