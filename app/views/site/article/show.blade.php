@extends('_frontend.master')
@section('breadcrumb')
{{ HTML::decode(Breadcrumbs::render('hirek.show',$article)) }}
@stop

@section('content')
<div class="article">

    <p class="text-muted date">{{$article->getCreatedAt()}}, {{$article->author->last_name}} {{$article->author->first_name}}</p>
    <h1 class="title">{{HTML::link($article->getLink(),$article->title)}}</h1>

    <div class="article-content">
        {{$article->content}}
    </div>

    <div class="labels">
        @if(sizeof($article->tagNames()) > 0)
            @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
                <span class="label label-greywhite">{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
            @endforeach
        @endif
    </div>

    @if(count($article->gallery)!=0 && count($article->gallery->pictures)!=0)
        <h4>Galéria</h4>

        <div class="article-gallery">
            <div class="gallery-carousel owl-carousel">
                @foreach($article->gallery->pictures as $picture)
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

    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'spetertszk'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>


</div>
@stop