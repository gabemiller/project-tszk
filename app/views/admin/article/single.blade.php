<tr>
    <td class="text-center">{{Form::input('checkbox','delete',$article->id,array('data-url'=> URL::route('admin.hir.destroy',array('id'=>$article->id))))}}</td>
    <td>{{$article->id}}</td>
    <td>{{$article->title}}</td>
    <td>{{$article->getAuthorName()}}</td>
    <td>{{str_replace('-','.',$article->created_at)}}</td>
    <td class="text-center">{{HTML::decode(HTML::linkRoute('admin.hir.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$article->id),array('class'=>'btn btn-sm btn-default')))}}</td>
</tr>