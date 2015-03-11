@extends('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('hirek.index')) }}
@stop
@section('content')
    <div class="row">
        @foreach($articles as $article)
            <div class="col-xs-12">
                <div class="articles">
                    <p class="text-muted date">{{$article->getCreatedAt()}}, {{$article->author->last_name}} {{$article->author->first_name}}</p>

                    <h2 class="title">{{HTML::link($article->getLink(),$article->title)}}</h2>

                    <p class="article-content">{{$article->getParragraph()}}</p>

                    {{HTML::linkRoute('hirek.show','Bővebben',array('id'=>$article->id,'title'=>\Str::slug($article->title)),array('class'=>'btn btn-sm btn-lightblue'))}}
                    <div class="labels">
                        @if(sizeof($article->tagNames()) > 0)
                            @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
                                <span class="label label-greywhite">{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                            @endforeach
                        @endif
                    </div>


                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        {{$articles->links()}}
    </div>
@stop