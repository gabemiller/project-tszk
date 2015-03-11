@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('fooldal')) }}
@stop

@section('content')

    <div class="row">
        @foreach($articles as $article)
            <div class="col-xs-12">
                <div class="articles">
                    <p class="text-muted date">{{$article->getCreatedAt()}}</p>
                    <h2 class="title">{{HTML::link($article->getLink(),$article->title)}}</h2>
                    <p class="article-content">{{$article->getParragraph()}}</p>
                    {{HTML::linkRoute('hirek.show','Bővebben',array('id'=>$article->id,'title'=>\Str::slug($article->title)),array('class'=>'btn btn-sm btn-darkgrey'))}}
                </div>
            </div>
        @endforeach
    </div>



@stop