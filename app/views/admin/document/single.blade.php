<tr>
    <td class="text-center">{{Form::input('checkbox','delete',$document->id,array('data-url'=> URL::route('admin.dokumentum.destroy',array('id'=>$document->id))))}}</td>
    <td>{{$document->id}}</td>
    <td>{{$document->name}}</td>
    <td>{{$document->path}}</td>
    <td>
        @foreach($document->categories as $cat)
            <span class="label label-divide">{{$cat->name}}</span>
        @endforeach
    </td>
    <td>{{str_replace('-','.',$document->created_at)}}</td>
    <td class="text-center">{{HTML::decode(HTML::linkRoute('admin.dokumentum.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$document->id),array('class'=>'btn btn-sm btn-default')))}}</td>
</tr>