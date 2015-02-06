@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Oldal</h1>
    {{ HTML::decode(Breadcrumbs::render('admin.oldal.edit')) }}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            
            @include('_backend.message')

             {{Form::open(array('url' => URL::route('admin.oldal.update',array('id'=>$page->id)),'class'=>'form-horizontal','method'=>'PUT'))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>


            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Oldal módosítása</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('title', 'Cím',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','title',$page->title,array('class'=>'form-control','Placeholder'=>'Cím'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Tartalom',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('content',$page->content,array('class'=>'ckeditor'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gallery', 'Hozzárendelt galéria',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-2">
                            {{Form::select('gallery', $galleries,$page->getGalleryId(),array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('published', 'Megjelenjen a főoldalon?',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::checkbox('published', 'true',$page->published,array('class'=>'btn-switch'))}}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</section>
@stop