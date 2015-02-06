@extend('_backend.master')
@section('content')
<section class="content-header">
    <h1>Új galéria</h1>
    {{HTML::decode(Breadcrumbs::render('admin.galeria.create'))}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @include('_backend.message')

            {{Form::open(array('url' => URL::route('admin.galeria.store'),'class'=>'form-horizontal','method'=>'POST'))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm'))}}
                </div>
            </div>


            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Galéria</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('name', 'Név',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','name','',array('class'=>'form-control','Placeholder'=>'Név'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Leírás',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('description','',array('class'=>'form-control','Placeholder'=>'Leírás'))}}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}

        </div>
    </div>
</section>
@stop