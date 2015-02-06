<tr>
    <td class="text-center">
        @if(FALSE)
        <input type="checkbox" name="delete" value="{{$usergroup->id}}">
        @endif
    </td>
    <td>{{$usergroup->id}}</td>
    <td>{{$usergroup->name}}</td>
    <td class="text-center">{{HTML::decode(HTML::linkRoute('felhasznalo-csoport.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$usergroup->id),array('class'=>'btn btn-sm btn-default')))}}</td>
</tr>