@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Új felhasználó</h1>
    {{HTML::decode(Breadcrumbs::render('admin.felhasznalok.felhasznalo.create'))}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @include('_backend.message')
            
            {{Form::open(array('url' => URL::route('admin.felhasznalok.felhasznalo.store'),'class'=>'form-horizontal','method'=>'POST'))}}
            <div class="col-lg-12">
                <div class="box box-solid">
                    <div class="box-body">
                        {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm'))}}
                    </div>
                </div>
            </div>

            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-12">
                <div class="box box-solid box-divide">
                    <div class="box-header">
                        <h3 class="box-title">Új felhasználó</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            {{Form::label('name','Név',array('class'=>'col-lg-2 control-label'))}}                
                            <div class="col-lg-4">
                                {{Form::input('text','last_name','',array('class'=>'form-control','placeholder'=>'Vezetéknév'))}}
                            </div>
                            <div class="col-lg-4">
                                {{Form::input('text','first_name','',array('class'=>'form-control','placeholder'=>'Keresztnév'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('email','Email',array('class'=>'col-lg-2 control-label'))}}
                            <div class="col-lg-8">
                                {{Form::input('email','email','',array('class'=>'form-control','placeholder'=>'Email'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('phone','Telefon',array('class'=>'col-lg-2 control-label'))}}
                            <div class="col-lg-8">
                                {{Form::input('tel','phone','',array('class'=>'form-control','placeholder'=>'Telefon'))}}
                            </div>
                        </div>

                    </div>
                </div> <!-- /.panel -->
            </div> <!-- /.col-lg-4 -->
            {{Form::close()}}


        </div>
    </div>
</section>

@stop