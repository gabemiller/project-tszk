@extend('_frontend.master')
@section('page-title')
    <h1>Letölthető dokumentumok</h1>
@stop

@section('breadcrumb')
    @if(count($category))
        {{HTML::decode(Breadcrumbs::render('dokumentumok.category',$category))}}
    @else
        {{HTML::decode(Breadcrumbs::render('dokumentumok.index'))}}
    @endif
@stop

@section('content')
    <div class="documents">

        <h1 class="title">Dokumetumok</h1>
        @if(count($category))
            <h3 class="title">Kategória: {{$category->name}}</h3>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-middle">
                <thead>
                <tr>
                    <th>Dokumentum</th>
                    <th>Létrehozva</th>
                    <th>Módosítva</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents as $doc)
                    <tr>
                        <td>
                            <h4 class="title">{{$doc->name}}</h4>

                            <p>{{$doc->description}}</p>

                            <p>
                                @foreach($doc->categories as $category)
                                    <span class="label label-greywhite">{{$category->name}}</span>
                                @endforeach
                            </p>
                        </td>
                        <td>{{$doc->getCreatedAt('Y.m.d.')}}</td>
                        <td>{{$doc->getUpdatedAt('Y.m.d.')}}</td>
                        <td class="table-col-xs">
                            {{HTML::decode(HTML::link($doc->path,'Letöltés',array('class'=>'btn btn-small
                            btn-lightblue','target'=>'_blank')))}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop