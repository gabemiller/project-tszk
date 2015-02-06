@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Dokumentum kategóriák</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('_backend.message')
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">

            {{Form::open(array('url' => URL::route('admin.dokumentum-kategoria.store',array()),'method'=>'POST'))}}
            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Új dokumentum kategória</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        {{Form::label('parent_id', 'Szülő kategória',array('class'=>'control-label'))}}
                        <div>
                            {{Form::select('parent_id', $categories,null,array('class'=>'form-control'));}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('name', 'Név',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('text','name','',array('class'=>'form-control','placeholder'=>'Név'))}}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm'))}}
                </div>
            </div>
            {{Form::close()}}

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Dokumentum kategóriák</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-sortable">
                            <thead>
                                <tr>
                                    <th class="table-col-xs sorter-false filter-false"><input type="checkbox" id="checkAll"></th>
                                    <th class="table-col-xs">Az</th>
                                    <th class="table-col-xs">Sz_Az</th>
                                    <th>Név</th>
                                    <th>Létrehozva</th>
                                    <th class="table-col-xs sorter-false filter-false">Beállítások</th>
                                </tr>           
                            </thead>
                            <tbody>
                                @each('admin.documentcategory.single',$docCategories,'docCategory','admin.documentcategory.empty')
                            </tbody>
                            @include('_backend.table-footer')
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::button('Törlés',array('type'=>'button','class'=>'btn btn-danger btn-sm','id'=>'deleteButton'))}}
                </div>
            </div>

        </div>
    </div>
</section>
@stop