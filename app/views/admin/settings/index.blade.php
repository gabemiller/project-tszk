@extends('_backend.master')
@section('content')
    <section class="content-header">
        <h1>Beállítások</h1>
        {{-- HTML::decode(Breadcrumbs::render('')) --}}
    </section>

    <section class="content">

        @include('_backend.message')

        <div class="row">
            <div class="col-xs-4">

                <div class="box box-solid box-divide">
                    <div class="box-header">
                        <h3 class="box-title">Karbantartás</h3>
                    </div>
                    {{Form::open(array('url' => URL::route('admin.karbantartas'),'class'=>'form-horizontal','method'=>'POST'))}}
                    <div class="box-body">

                        <div class="form-group">
                            {{Form::label('published', 'Karbantartás mód aktív',array('class'=>'col-lg-5 control-label'))}}
                            <div class="col-lg-7">
                                {{Form::checkbox('maintenance', !App::isDownForMaintenance(),App::isDownForMaintenance(),array('class'=>'btn-switch'))}}
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm'))}}
                    </div>
                    {{Form::close()}}
                </div>

            </div>
        </div>
    </section>
@stop