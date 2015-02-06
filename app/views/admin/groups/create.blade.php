@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Új felhasználói csoport</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <form class="form-horizontal ajax-form" action="usergroup/upload" method="post">

                <div class="box box-solid">
                    <div class="box-body">
                        {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm btn-ajax'))}}
                    </div>
                </div>

                <div class="box box-solid box-divide">
                    <div class="box-header">
                        <h3 class="box-title">Új felhasználói csoport</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group hidden">
                            <label for="userGroupId" class="col-lg-2 control-label">Azonosító</label>
                            <div class="col-lg-2">
                                <input id="itemCategoryId" name="userGroupId" type="hidden" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userGroupName" class="col-lg-2 control-label">Csoport neve</label>
                            <div class="col-lg-4">
                                <input id="itemCategory" name="userGroupName" type="text" class="form-control" placeholder="Csoport neve" value="">
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
</section>

@stop