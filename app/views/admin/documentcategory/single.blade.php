<tr>
    <td class="text-center">{{Form::input('checkbox','delete',$docCategory->id,array('data-url'=> URL::route('admin.dokumentum-kategoria.destroy',array('id'=>$docCategory->id))))}}</td>
    <td>{{$docCategory->id}}</td>
    <td>{{$docCategory->parent_id}}</td>
    <td>{{$docCategory->name}}</td>
    <td>{{$docCategory->created_at}}</td>
    <td class="text-center">{{HTML::decode(HTML::linkRoute('admin.dokumentum-kategoria.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$docCategory->id),array('class'=>'btn btn-sm btn-default')))}}</td>
</tr>