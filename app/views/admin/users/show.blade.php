@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>{{$user->getFullName() }}</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('_backend.message')
        </div>
    </div>
    <div class="row">

        {{Form::open(array('url' =>
        URL::route('admin.felhasznalok.felhasznalo.change',array('id'=>$user->id)),'method'=>'POST'))}}

        <div class="col-sx-12 col-sm-12 col-md-4 col-lg-4">
            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Profil</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        {{Form::label('name','Név',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('text','',$user->last_name,array('class'=>'form-control','disabled'))}}
                            {{Form::input('hidden','last_name',$user->last_name)}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            {{Form::input('text','',$user->first_name,array('class'=>'form-control','disabled'))}}
                            {{Form::input('hidden','first_name',$user->first_name)}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('email','Email',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('email','email',$user->email,array('class'=>'form-control','placeholder'=>'Email'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('phone','Telefon',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('tel','phone',$user->phone,array('class'=>'form-control','placeholder'=>'Telefon'))}}
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm'))}}
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        {{Form::close()}}


        {{Form::open(array('url' =>
        URL::route('admin.felhasznalok.felhasznalo.password',array('id'=>$user->id)),'method'=>'POST'))}}

        <div class="col-sx-12 col-sm-12 col-md-4 col-lg-4">
            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Jelszó</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        {{Form::label('oldPwd','Régi jelszó',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('password','oldPwd','',array('class'=>'form-control','placeholder'=>'Régi jelszó'))}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('newPwd','Új jelszó',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('password','newPwd','',array('class'=>'form-control','placeholder'=>'Új jelszó'))}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('newPwd2','Új jelszó megerősítése',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('password','newPwd2','',array('class'=>'form-control','placeholder'=>'Új jelszó megerősítése'))}}
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm'))}}
                </div>
            </div>
        </div>
        {{Form::close()}}


        {{Form::open(array('url' =>
        URL::route('admin.felhasznalok.felhasznalo.picture',array('id'=>$user->id)),'files' =>true,'method'=>'POST'))}}

        <div class="col-sx-12 col-sm-12 col-md-4 col-lg-4">
            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Profilkép</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">

                        <div>
                            <img src="{{$user->getThumbProfilePicture()}}" width="250" height="250"
                                 class="img-responsive" alt="{{$user->getFullName()}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('picture','Profilkép',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('file','picture','',array('class'=>'form-control'))}}
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    {{Form::button('Feltöltés',array('type'=>'submit','class'=>'btn btn-divide btn-sm'))}}
                    {{HTML::linkRoute('admin.felhasznalok.felhasznalo.delete.picture','Törlés',array('id'=>$user->id),array('class'=>'btn
                    btn-danger btn-sm'))}}
                </div>
            </div>
        </div>
        {{Form::close()}}


    </div>
</section>
@stop