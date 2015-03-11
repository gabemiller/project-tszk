@extend('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('esemenyek.show',$event)) }}
@stop
@section('content')

    <div class="event">
        <p class="text-muted date">Az esemény ideje: {{$event->getStartAt()}} - {{$event->getEndAt()}} </p>

        <h1 class="title">
            {{HTML::link($event->getLink(),$event->title)}}
            @if($event->isNowActive())
                <span class="label label-red label-active" title="Jelenleg az esemény folyamatban van!">Aktív</span>
            @endif
        </h1>

        <div class="event-content">
            {{$event->content}}
        </div>

        <div class="labels">
            @if(sizeof($event->tagNames()) > 0)
                @foreach(\Divide\Helper\Tag::getTagByName($event->tagNames()) as $tag)
                    <span class="label label-greywhite">{{HTML::linkRoute('esemenyek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                @endforeach
            @endif
        </div>

        @if(count($event->gallery)!=0 && count($event->gallery->pictures)!=0)
            <h4>Galéria</h4>

            <div class="event-gallery">
                <div class="gallery-carousel owl-carousel">
                    @foreach($event->gallery->pictures as $picture)
                        <div>
                            <a href="{{URL::to($picture->picture_path)}}" title="{{$picture->name}}" data-gallery>
                                <img class="img-responsive" src="{{URL::to($picture->thumbnail_path)}}"
                                     alt="{{$picture->name}}"
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
            (function () {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>

    </div>
@stop