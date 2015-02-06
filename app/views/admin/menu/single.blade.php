<tr>
    <td class="text-center">{{Form::input('checkbox','delete',$menuItem->id,array('data-url'=> URL::route('admin.menu-kezelo.destroy',array('id'=>$menuItem->id))))}}</td>
    <td>{{$menuItem->id}}</td>
    <td>@if($menuItem->parent_id == null) 0 @else {{$menuItem->parent_id}} @endif</td>
    <td>{{$menuItem->name}}</td>
    <td><code>{{$menuItem->url}}</code></td>
    <td>{{$menuItem->created_at}}</td>
    <td>{{$menuItem->updated_at}}</td>
    <td class="text-center">{{HTML::decode(HTML::linkRoute('admin.menu-kezelo.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$menuItem->id),array('class'=>'btn btn-sm btn-default')))}}</td>
</tr>