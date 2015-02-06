<tr>
    <td class="text-center">
        @if(!$gallery->hasPicture())
        {{Form::input('checkbox','delete',$gallery->id,array('data-url'=> URL::route('admin.galeria.destroy',array('id'=>$gallery->id))))}}
        @endif
    </td>
    <td>{{$gallery->id}}</td>
    <td>{{$gallery->name}}</td>
    <td>{{str_replace('-','.',$gallery->created_at)}}</td>
    <td class="text-center">
        <div class="btn-group">
            {{HTML::decode(HTML::linkRoute('admin.galeria.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$gallery->id),array('class'=>'btn btn-sm btn-default')))}}
            {{HTML::decode(HTML::linkRoute('admin.galeria.kep.upload','<i class="fa fa-photo"></i> Képfeltöltés',array('id'=>$gallery->id),array('class'=>'btn btn-sm btn-default')))}}
        </div>
    </td>
</tr>