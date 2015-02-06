@extend('_backend.master')
@section('content')
<section class="content-header">
    <h1>Új dokumentum</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @include('_backend.message')

            {{Form::open(array('url' => URL::route('admin.dokumentum.store',array()),'class'=>'form-horizontal','method'=>'POST','files'=>true))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Új dokumentum</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('name', 'Cím',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','name','',array('class'=>'form-control','placeholder'=>'Cím'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Leírás',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('description','',array('class'=>'form-control','placeholder'=>'Leírás'))}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('file', 'Dokumentum',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('file','file','',array('class'=>'form-control','placeholder'=>'Dokumentum'))}}
                        </div>
                    </div>

                     <div class="form-group">
                         {{Form::label('category', 'Kategória',array('class'=>'col-lg-2 control-label'))}}
                         <div class="col-lg-2">
                            {{Form::select('category[]', $categories,null,array('class'=>'form-control','multiple'=>'multiple'))}}
                         </div>
                     </div>
                </div>
            </div>
            {{Form::close()}}

        </div>
    </div>
</section>
@stop