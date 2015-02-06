@extend('_backend.master')
@section('content')
<section class="content-header">
    <h1>Esemény módosítása</h1>
    {{HTML::decode(Breadcrumbs::render('admin.esemeny.edit'))}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            
            @include('_backend.message')

           {{Form::open(array('url' => URL::route('admin.esemeny.update',array('id'=>$event->id)),'class'=>'form-horizontal','method'=>'PUT'))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Esemény módosítás</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('title', 'Cím',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','title',$event->title,array('class'=>'form-control','placeholder'=>'Cím'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('date', 'Időpont',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-3">
                            <div class="input-group">
                                {{Form::input('text','start_at',str_replace('-','.',$event->start_at),array('id'=>'dateTimeStart','class'=>'form-control','placeholder'=>date('Y.m.d H:i')))}}
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                {{Form::input('text','end_at',str_replace('-','.',$event->end_at),array('id'=>'dateTimeEnd','class'=>'form-control','placeholder'=>date('Y.m.d H:i')))}}
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Tartalom',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('content',$event->content,array('class'=>'ckeditor'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('tags', 'Cimke',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','tags',implode(',',$event->tagNames()),array('class'=>'form-control','placeholder'=>'Cimke'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('published', 'Megjelenjen az események között?',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::checkbox('published', 'true',$event->published,array('class'=>'btn-switch'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gallery', 'Hozzárendelt galéria',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-2">
                            {{Form::select('gallery',$galleries, $event->getGalleryId(),array('class'=>'form-control'))}}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}

        </div>
    </div>
</section>
@stop