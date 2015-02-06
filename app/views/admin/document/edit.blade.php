@extend('_backend.master')
@section('content')
<section class="content-header">
    <h1>Dokumentum módosítása</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @include('_backend.message')

            {{Form::open(array('url' => URL::route('admin.dokumentum.update',array('id'=>$document->id)),'class'=>'form-horizontal','method'=>'PUT','files'=>true))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Dokumentum módosítása</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('name', 'Cím',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','name',$document->name,array('class'=>'form-control','placeholder'=>'Cím'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Leírás',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('description',$document->description,array('class'=>'form-control','placeholder'=>'Leírás'))}}
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
                          {{Form::select('category[]', $categories,$catIds,array('class'=>'form-control','multiple'=>'multiple'))}}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}


        </div>
    </div>
</section>
@stop