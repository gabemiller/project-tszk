@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Dokumentum kategória módosítás</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @include('_backend.message')

            {{Form::open(array('url' => URL::route('admin.dokumentum-kategoria.update',array('id'=>$docCategory->id)),'class'=>'form-horizontal','method'=>'PUT'))}}

            <div class="box box-solid">
                <div class="box-body">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>


            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Dokumentum kategória módosítás</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        {{Form::label('parent_id', 'Szülő kategória',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-2">
                            {{Form::selection('parent_id', $categories,array('class'=>'form-control'),$docCategory->parent)}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('name', 'Név',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','name',$docCategory->name,array('class'=>'form-control','placeholder'=>'Név'))}}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}

        </div>
    </div>
</section>
@stop