@extend('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('esemenyek.index')) }}
@stop
@section('content')

    @foreach($events as $event)
        <div class="events">
            <p class="text-muted date">Az esemény ideje: {{$event->getStartAt()}} - {{$event->getEndAt()}} </p>

            <h2 class="title">
                {{HTML::link($event->getLink(),$event->title)}}
                @if($event->isNowActive())
                    <span class="label label-red label-active" title="Jelenleg az esemény folyamatban van!">Aktív</span>
                @endif
            </h2>

            <p class="event-content">{{$event->getParragraph()}}</p>

            {{HTML::linkRoute('esemenyek.show','Bővebben',array('id'=>$event->id,'title'=>\Str::slug($event->title)),array('class'=>'btn btn-sm btn-lightblue'))}}
            <div class="labels">
                @if(sizeof($event->tagNames()) > 0)
                    @foreach(\Divide\Helper\Tag::getTagByName($event->tagNames()) as $tag)
                        <span class="label label-greywhite">{{HTML::linkRoute('esemenyek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach

    <div class="text-center">
        {{$events->links();}}
    </div>

@stop