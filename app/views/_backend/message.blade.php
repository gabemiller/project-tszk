@if($errors->has())
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-times"></i>
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Bezárás</span></button>
    <h4>Hiba</h4>
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif

@if(Session::has('message'))
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-check"></i>
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Bezárás</span></button>
    <h4>Siker</h4>
    <p>{{Session::get('message')}}</p>
</div>
@endif