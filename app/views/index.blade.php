@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('fooldal')) }}
@stop

@section('content')

    <div class="row">
        <div class="col-xs-8">
            <div class="page">

                <h1 class="title">{{$page->title}}</h1>

                <div class="page-content">
                    {{$page->content}}
                </div>

                @if(count($page->gallery)!=0 && count($page->gallery->pictures)!=0)
                    <h4>Galéria</h4>

                    <div class="page-gallery">
                        <div class="gallery-carousel owl-carousel">
                            @foreach($page->gallery->pictures as $picture)
                                <div>
                                    <a href="{{URL::to($picture->picture_path)}}" title="{{$picture->name}}"
                                       data-gallery>
                                        <img class="img-responsive" src="{{URL::to($picture->thumbnail_path)}}"
                                             alt="{{$picture->name}}"
                                             title="{{$picture->name}}"/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="col-xs-4">
            <h4>Legfrissebb hírek</h4>
            <h4>Képek a galériából</h4>
        </div>
    </div>



@stop