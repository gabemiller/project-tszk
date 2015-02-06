@extend('_frontend.master')
@section('page-title')
<h1>Letölthető dokumentumok</h1>
@stop

@section('breadcrumb')
{{-- HTML::decode(Breadcrumbs::render('')) --}}
@stop

@section('sidebar')
<h3>Kategóriák</h3>
<ul class="list-unstyled list-category">
    <li>{{HTML::linkRoute('dokumentumok.index','Összes kategória')}}</li>
    @foreach($categories as $category)
    <li>{{HTML::linkRoute('dokumentumok.index',$category->name.' ('.$category->documents->count().')',array('slug'=>$category->slug))}}
    </li>
    @endforeach
</ul>
@stop

@section('content')
<div class="documents">

    <div class="table-responsive">
        <table class="table table-middle">
            <tbody>
            @foreach($documents as $doc)
            <tr>
                <td>
                    <h3>{{$doc->name}}</h3>
                    <p>{{$doc->description}}</p>
                    <p>
                        @foreach($doc->categories as $category)
                        <span class="label label-primary">{{$category->name}}</span>
                        @endforeach
                    </p>
                </td>
                <td class="table-col-xs">
                    {{HTML::decode(HTML::link($doc->path,'Letöltés',array('class'=>'btn btn-small
                    btn-default','target'=>'_blank')))}}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop