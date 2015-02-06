<tr>
    <td class="text-center">
        {{Form::input('checkbox','delete',$page->id,array('data-url'=> URL::route('admin.oldal.destroy',array('id'=>$page->id))))}}
    </td>
    <td>{{$page->id}}</td>
    <td>{{$page->title}}</td>
    <td class="text-center">
        {{HTML::decode(HTML::linkRoute('admin.oldal.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$page->id),array('class'=>'btn btn-sm btn-default')))}}
    </td>
</tr>