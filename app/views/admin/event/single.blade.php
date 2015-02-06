<tr>
    <td class="text-center">{{Form::input('checkbox','delete',$event->id,array('data-url'=> URL::route('admin.esemeny.destroy',array('id'=>$event->id))))}}</td>
    <td>{{$event->id}}</td>
    <td>{{$event->title}}</td>
    <td>{{str_replace('-','.',$event->start_at)}}</td>
    <td>{{str_replace('-','.',$event->end_at)}}</td>
    <td class="text-center">{{HTML::decode(HTML::linkRoute('admin.esemeny.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$event->id),array('class'=>'btn btn-sm btn-default')))}}</td>
</tr>