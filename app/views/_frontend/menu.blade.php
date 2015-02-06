@foreach ($items as $item)
<li class=" @if($item->hasChildren())dropdown @endif @if($item->link->path['url'] == Request::url()) active @endif">
@if(!$item->hasChildren())
<a href="{{ $item->link->path['url'] }}">{{$item->title }} </a>
@else
<a href="{{ $item->link->path['url'] }}">{{$item->title }} <span class="caret"></span></a>
@endif
@if ($item->hasChildren())
<ul>
    @include('_frontend.menu', array('items' => $item->children()))
</ul>
@endif
</li >
@endforeach