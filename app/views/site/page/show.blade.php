@extend('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('oldalak.show',$page)) }}
@stop
@section('content')
    <div class="page">

        <h1>{{$page->title}}</h1>

        <div class="page-content">
            {{$page->content}}
        </div>

        @if(count($page->gallery)!=0 && count($page->gallery->pictures)!=0)
            <h4>Galéria</h4>

            <div class="page-gallery">
                <div class="page-carousel owl-carousel">
                    @foreach($page->gallery->pictures as $picture)
                        <div>
                            <a href="{{URL::to($picture->picture_path)}}" title="{{$picture->name}}" data-gallery>
                                <img class="img-responsive" src="{{URL::to($picture->thumbnail_path)}}" alt="{{$picture->name}}"
                                     title="{{$picture->name}}"/>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
@stop