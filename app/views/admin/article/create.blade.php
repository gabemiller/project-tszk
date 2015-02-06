@extend('_backend.master')
@section('content')
<section class="content-header">
    <h1>Új hír felvétele</h1>
    {{HTML::decode(Breadcrumbs::render('admin.hir.create'))}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            
            @include('_backend.message')

            {{Form::open(array('url' => URL::route('admin.hir.store',array()),'class'=>'form-horizontal','method'=>'POST'))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Új hír</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('title', 'Cím',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','title','',array('class'=>'form-control','placeholder'=>'Cím'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('author_id', 'Szerző',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','',$user->getFullName(),array('class'=>'form-control','disabled'=>'disabled'))}}
                            {{Form::input('hidden','author_id',$user->id,array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Tartalom',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('content','',array('class'=>'ckeditor'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('tags', 'Cimke',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','tags','',array('class'=>'form-control','placeholder'=>'Cimke'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('published', 'Megjelenjen a hírek között?',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::checkbox('published', 'true',false,array('class'=>'btn-switch'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gallery_id', 'Hozzárendelt galéria',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-2">
                            {{Form::select('gallery_id', $galleries,null,array('class'=>'form-control'));}}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</section>
@stop