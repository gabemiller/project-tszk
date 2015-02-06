@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Oldal</h1>
    {{ HTML::decode(Breadcrumbs::render('admin.oldal.create')) }}
</section>

<section class="content">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('_backend.message')
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            
            {{Form::open(array('url' => URL::route('admin.oldal.store'),'class'=>'form-horizontal','method'=>'POST'))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>


            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Oldal</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('title', 'Cím',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','title','',array('class'=>'form-control','Placeholder'=>'Cím'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Tartalom',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('content','',array('class'=>'ckeditor'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gallery_id', 'Hozzárendelt galéria',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-2">
                            {{Form::select('gallery_id', $galleries,null,array('class'=>'form-control'));}}
                        </div>
                    </div>
                    <div class="form-group">
                          {{Form::label('published', 'Megjelenjen a főoldalon?',array('class'=>'col-lg-2 control-label'))}}
                          <div class="col-lg-9">
                            {{Form::checkbox('published', 'true',false,array('class'=>'btn-switch'))}}
                          </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</section>
@stop