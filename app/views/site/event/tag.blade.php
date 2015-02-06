@extend('_frontend.master')
@section('breadcrumb')
{{ HTML::decode(Breadcrumbs::render('esemenyek.tag',$tag)) }}
@stop
@section('content')

@foreach($events as $event)
<div class="event list-box">
    <h3>{{HTML::link($event->getLink(),$event->title)}}</h3>
    <p class="small">Kezdés: {{$event->start}} | Befejezés: {{$event->end}} </p>
    <p class="text-justify">{{$event->getParragraph()}}</p>
    <div class="tags">
        @if(sizeof($event->tagNames()) > 0)
        @foreach(\Divide\Helper\Tag::getTagByName($event->tagNames()) as $tag)
        <span class="label label-banhorvati-blue">{{HTML::linkRoute('esemenyek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
        @endforeach
        @endif
    </div>
</div> 
@endforeach

<div class="text-center">
    {{$events->links();}}
</div>

@stop