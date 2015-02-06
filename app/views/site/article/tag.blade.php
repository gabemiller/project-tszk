@extends('_frontend.master')
@section('breadcrumb')
{{ HTML::decode(Breadcrumbs::render('hirek.tag',$tag)) }}
@stop
@section('content')

@foreach($articles as $article)
<div class="article list-box">
    <h3>{{HTML::link($article->getLink(),$article->title)}}</h3>

    <p class="small">
        <strong>{{$article->getAuthorName()}}</strong> <br>
        {{$article->getCreatedAt()}}
    </p>

    <p class="text-justify">{{$article->getParragraph()}}</p>

    <div class="tags">
        @if(sizeof($article->tagNames()) > 0)
        @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
        <span class="label label-banhorvati-blue">{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
        @endforeach
        @endif
    </div>
</div>
@endforeach

<div class="text-center">
    {{$articles->links();}}
</div>

@stop