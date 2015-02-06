@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Felhasználói csoportok</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-solid">
                <div class="box-body">
                    <a class="btn btn-divide btn-sm" href="?page=usergroup">Új csoport</a>
                    <button id="deleteButton" type="button" class="btn btn-danger btn-sm" data-servlet="">Törlés</button>
                </div>
            </div>

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Felhasználói csoportok</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-sortable">
                            <thead>
                                <tr>
                                    <th class="table-col-xs sorter-false filter-false"><input type="checkbox" id="checkAll"></th>
                                    <th class="table-col-xs">Id</th>
                                    <th>Név</th>
                                    <th class="table-col-xs sorter-false filter-false">Beállítások</th>
                                </tr>           
                            </thead>
                            <tbody>
                                @each('admin.groups.single',$usergroups,'usergroup','admin.groups.empty')
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@stop