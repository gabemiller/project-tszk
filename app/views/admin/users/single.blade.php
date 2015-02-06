<tr>
    <td class="text-center">
        @if($u->deletable)
            @if($u->id != $user->id)
                {{Form::input('checkbox','delete',$u->id,array('data-url'=> URL::route('admin.felhasznalok.felhasznalo.destroy',array('id'=>$u->id))))}}
            @endif
        @endif
    </td>
    <td class="text-right">{{$u->id}}</td>
    <td>{{$u->last_name.' '.$u->first_name}}</td>
    <td>{{$u->email}}</td>
    <td>{{$u->phone}}</td>
    <td>{{$u->getRegistrationDate()}}</td>
    <td>{{$u->getLastLogin()}}</td>
    <td class="text-center">{{HTML::decode(HTML::linkRoute('admin.felhasznalok.felhasznalo.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$u->id),array('class'=>'btn btn-sm btn-default')))}}</td>
</tr>