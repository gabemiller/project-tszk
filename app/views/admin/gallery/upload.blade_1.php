@extend('_backeng.master')
@section('content')
<section class="content-header">
    <h1>Képfeltöltés</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @include('_backend.message')

            <div class="box box-solid">
                <div class="box-body">
                    {{Form::open(array('url' => URL::route('admin.galeria.kep.save'),'class'=>'form-horizontal form-ajax-upload','method'=>'POST','files'=>true))}}


                    {{Form::input('hidden','id',$gallery->id,array('class'=>'form-control'))}}
                    {{Form::input('file','files','',array('class'=>'form-control input-upload hidden','multiple'))}}
                    {{Form::button('Feltöltés',array('type'=>'submit','class'=>'btn btn-sm btn-divide btn-upload'))}}

                    {{Form::close()}}
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar progress-bar-divide" style="width: 0%"></div>
            </div>

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Képfeltöltés</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-sortable table-upload">
                            <thead>
                            <th class="table-col-xs sorter-false filter-false">Kép</th>
                            <th>Név</th>
                            <th class="table-col-xs sorter-false filter-false">Törlés</th>
                            </thead>
                            <tbody>
                                @if(sizeof($gallery->pictures->toArray()) == 0)
                                <tr>
                                    <td class="table-empty text-center" colspan="14">Jelenleg nincs még kép a galériában!</td>
                                </tr>
                                @endif
                                @foreach($gallery->pictures as $picture)
                                <tr>
                                    <td><a href="{{$picture->picture_path}}" target="_blank"><img src='{{$picture->thumbnail_path}}' width='100'/></a></td>
                                    <td>{{$picture->name}}</td>
                                    <td>{{HTML::decode(HTML::linkRoute('admin.galeria.kep.delete','<i class="fa fa-times"></i> Törlés',array('id'=>$picture->id),array('class'=>'btn btn-sm btn-danger btn-ajax-delete')))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@stop