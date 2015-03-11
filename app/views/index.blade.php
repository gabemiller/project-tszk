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
            <h3 class="sidebar-title">Legfrissebb híreink <span class="title-arrow"></span></h3>
            @if(count($articles))
                @foreach($articles as $article)
                    <div class="articles">
                        <p class="text-muted date small">{{$article->getCreatedAt()}}</p>
                        <h4 class="title">{{HTML::link($article->getLink(),$article->title)}}</h4>
                        <div class="labels">
                            @if(sizeof($article->tagNames()) > 0)
                                @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
                                    <span class="label label-greywhite">{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

            <h3 class="sidebar-title">Képek a galériánkból <span class="title-arrow"></span></h3>
            @if(count($pictures))
                <div class="side-gallery">
                    <div class="side-carousel">
                        @foreach($pictures as $picture)
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



@stop